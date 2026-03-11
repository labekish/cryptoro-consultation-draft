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
    var setState = function (item, expanded) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');
      if (!question || !answer) {
        return;
      }

      question.setAttribute('aria-expanded', String(expanded));
      answer.hidden = !expanded;
    };

    items.forEach(function (item) {
      var question = item.querySelector('.faq-item__question');
      var answer = item.querySelector('.faq-item__answer');

      if (!question || !answer) {
        return;
      }

      // Синхронизируем class/state с изначальной разметкой.
      setState(item, question.getAttribute('aria-expanded') === 'true');

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
