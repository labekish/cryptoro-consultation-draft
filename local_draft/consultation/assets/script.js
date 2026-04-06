(function () {
  'use strict';

  // Плавная прокрутка к секциям по кнопкам с data-scroll-to.
  function initSmoothScroll() {
    var controls = document.querySelectorAll('[data-scroll-to]');

    controls.forEach(function (control) {
      if (control.dataset.scrollBound === '1') {
        return;
      }
      control.dataset.scrollBound = '1';

      control.addEventListener('click', function () {
        var selector = control.getAttribute('data-scroll-to');
        if (!selector) {
          return;
        }

        var target = document.querySelector(selector);
        if (!target) {
          return;
        }

        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      });
    });
  }

  // Аккордеон FAQ: открываем только один пункт за раз.
  function initFaqAccordion() {
    var items = document.querySelectorAll('[data-faq-item]');
    var setState = function (item, expanded) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');
      if (!question || !answer) {
        return;
      }

      question.setAttribute('aria-expanded', String(expanded));
      answer.setAttribute('aria-hidden', String(!expanded));
      item.classList.toggle('is-open', expanded);
    };

    items.forEach(function (item) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');

      if (!question || !answer) {
        return;
      }

      // Убираем hidden, чтобы CSS-анимация работала стабильно при каждом переключении.
      answer.hidden = false;
      answer.removeAttribute('hidden');

      // Синхронизируем начальное состояние FAQ без анимации.
      setState(item, question.getAttribute('aria-expanded') === 'true');

      if (question.dataset.faqBound === '1') {
        return;
      }
      question.dataset.faqBound = '1';

      question.addEventListener('click', function () {
        var isExpanded = question.getAttribute('aria-expanded') === 'true';

        items.forEach(function (otherItem) {
          setState(otherItem, false);
        });

        setState(item, !isExpanded);
      });
    });
  }

  // Локальная mock-обработка формы (используется только если нет Bitrix WebForm).
  function initMockForm() {
    var form = document.querySelector('.consult-form--mock');
    if (!form) {
      return;
    }

    var result = form.querySelector('[data-form-result]');
    var consent = form.querySelector('input[name="consent"]');

    if (form.dataset.formBound === '1') {
      return;
    }
    form.dataset.formBound = '1';

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var consentAccepted = !consent || consent.checked;
      var formValid = form.checkValidity();

      if (!consentAccepted || !formValid) {
        if (result) {
          result.hidden = false;
          result.className = 'consult-form__result consult-form__result--error';
          result.textContent = !consentAccepted
            ? 'Необходимо согласие на обработку персональных данных.'
            : 'Пожалуйста, заполните обязательные поля.';
        }

        if (!consentAccepted && consent) {
          consent.focus();
        } else {
          form.reportValidity();
        }
        return;
      }

      if (result) {
        result.hidden = false;
        result.className = 'consult-form__result consult-form__result--success';
        result.textContent = 'Заявка принята в локальном режиме. После интеграции в Bitrix включим реальную отправку.';
      }

      form.reset();
    });
  }

  // Убираем висячие короткие слова (предлоги/союзы) в текстовых блоках.
  function fixWidows() {
    var root = document.querySelector('.consult-page');
    if (!root) {
      return;
    }

    var shortWords = [
      'и', 'а', 'но', 'не', 'ни', 'в', 'во', 'на', 'по', 'к', 'ко',
      'с', 'со', 'о', 'об', 'от', 'до', 'из', 'за', 'у'
    ];
    var shortWordsPattern = new RegExp(
      '(^|[\\s\\u00A0(«„\\"—-])(' + shortWords.join('|') + ')\\s+(?=[А-Яа-яЁёA-Za-z0-9])',
      'gi'
    );
    var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
    var textNode;

    while ((textNode = walker.nextNode())) {
      var value = textNode.nodeValue;
      if (!value || !value.trim()) {
        continue;
      }

      var parent = textNode.parentElement;
      if (!parent) {
        continue;
      }

      if (
        parent.closest('script,style,textarea,input,select,option,code,pre') ||
        parent.closest('.faq-item__index,.step-card__index,.btn__hex-icon,.pricing__price,.metric-item strong')
      ) {
        continue;
      }

      var normalized = value
        .replace(shortWordsPattern, function (_, prefix, word) {
          return prefix + word + '\u00A0';
        })
        .replace(/\s+—\s+/g, '\u00A0— ');

      if (normalized !== value) {
        textNode.nodeValue = normalized;
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    var root = document.querySelector('.consult-page');
    if (!root || root.dataset.consultInit === '1') {
      return;
    }
    root.dataset.consultInit = '1';

    initSmoothScroll();
    initFaqAccordion();
    initMockForm();
    initAddToCart();
    fixWidows();
  });

  // Заглушка корзины: складываем выбранную услугу в localStorage и показываем тост.
  // Когда появится бэкенд (WooCommerce/Bitrix), заменим тело обработчика на реальный запрос.
  function initAddToCart() {
    var buttons = document.querySelectorAll('[data-add-to-cart]');
    if (!buttons.length) {
      return;
    }

    var STORAGE_KEY = 'cryptoro_cart_draft';

    function readCart() {
      try {
        var raw = window.localStorage.getItem(STORAGE_KEY);
        return raw ? JSON.parse(raw) : [];
      } catch (e) {
        return [];
      }
    }

    function writeCart(items) {
      try {
        window.localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
      } catch (e) {}
    }

    function showToast(message) {
      var toast = document.querySelector('.cart-toast');
      if (!toast) {
        toast = document.createElement('div');
        toast.className = 'cart-toast';
        document.querySelector('.consult-page').appendChild(toast);
      }
      toast.textContent = message;
      // reflow для повторной анимации
      void toast.offsetWidth;
      toast.classList.add('is-visible');
      clearTimeout(toast._hideTimer);
      toast._hideTimer = setTimeout(function () {
        toast.classList.remove('is-visible');
      }, 2400);
    }

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = btn.getAttribute('data-product-id') || 'unknown';
        var title = btn.getAttribute('data-product-title') || 'Услуга';
        var price = parseFloat(btn.getAttribute('data-product-price') || '0') || 0;

        var cart = readCart();
        var existing = null;
        for (var i = 0; i < cart.length; i++) {
          if (cart[i].id === id) { existing = cart[i]; break; }
        }
        if (existing) {
          existing.qty += 1;
        } else {
          cart.push({ id: id, title: title, price: price, qty: 1 });
        }
        writeCart(cart);

        btn.classList.add('is-added');
        var label = btn.querySelector('.btn__cart-label');
        if (label) { label.textContent = 'Добавлено'; }
        showToast('«' + title + '» добавлена в корзину');

        setTimeout(function () {
          btn.classList.remove('is-added');
          if (label) { label.textContent = 'В корзину'; }
        }, 2400);
      });
    });
  }
})();
