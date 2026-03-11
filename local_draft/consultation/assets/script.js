(function () {
  'use strict';

  // Плавная прокрутка к секциям по кнопкам с data-scroll-to.
  function initSmoothScroll() {
    var controls = document.querySelectorAll('[data-scroll-to]');

    controls.forEach(function (control) {
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
    var setState = function (item, expanded, instant) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');
      if (!question || !answer) {
        return;
      }

      question.setAttribute('aria-expanded', String(expanded));

      if (expanded) {
        answer.hidden = false;
        var openHeight = answer.scrollHeight;

        if (instant) {
          answer.style.maxHeight = openHeight + 'px';
          answer.style.opacity = '1';
          return;
        }

        answer.style.maxHeight = '0px';
        answer.style.opacity = '0';
        answer.offsetHeight;
        answer.style.maxHeight = openHeight + 'px';
        answer.style.opacity = '1';
        return;
      }

      if (instant) {
        answer.style.maxHeight = '0px';
        answer.style.opacity = '0';
        answer.hidden = true;
        return;
      }

      if (answer.hidden) {
        answer.style.maxHeight = '0px';
        answer.style.opacity = '0';
        return;
      }

      answer.style.maxHeight = answer.scrollHeight + 'px';
      answer.style.opacity = '1';
      answer.offsetHeight;
      answer.style.maxHeight = '0px';
      answer.style.opacity = '0';
    };

    items.forEach(function (item) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');

      if (!question || !answer) {
        return;
      }

      answer.addEventListener('transitionend', function (event) {
        if (event.propertyName !== 'max-height') {
          return;
        }

        var expanded = question.getAttribute('aria-expanded') === 'true';
        if (!expanded) {
          answer.hidden = true;
          return;
        }

        answer.style.maxHeight = answer.scrollHeight + 'px';
      });

      // Синхронизируем начальное состояние FAQ без анимации.
      setState(item, question.getAttribute('aria-expanded') === 'true', true);

      question.addEventListener('click', function () {
        var isExpanded = question.getAttribute('aria-expanded') === 'true';

        items.forEach(function (otherItem) {
          setState(otherItem, false, false);
        });

        setState(item, !isExpanded, false);
      });
    });

    window.addEventListener('resize', function () {
      items.forEach(function (item) {
        var question = item.querySelector('.faq-item__question');
        var answer = item.querySelector('.faq-item__answer');
        if (!question || !answer) {
          return;
        }

        if (question.getAttribute('aria-expanded') === 'true') {
          answer.style.maxHeight = answer.scrollHeight + 'px';
        }
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

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      if (!form.checkValidity()) {
        if (result) {
          result.hidden = false;
          result.className = 'consult-form__result consult-form__result--error';
          result.textContent = 'Пожалуйста, заполните обязательные поля.';
        }
        form.reportValidity();
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

  document.addEventListener('DOMContentLoaded', function () {
    initSmoothScroll();
    initFaqAccordion();
    initMockForm();
  });
})();
