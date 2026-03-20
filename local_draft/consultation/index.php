<?php
/**
 * Локальный черновик посадочной страницы консультации.
 * Важно: это автономный шаблон для согласования структуры до интеграции в рабочий Bitrix-проект.
 */

$CONSULT_FORM_ID = 0; // TODO: замените на реальный ID веб-формы в Bitrix.
$PRIVACY_URL = '/privacy-policy/'; // TODO: замените на фактический URL политики конфиденциальности.
$PAGE_SLUG = '/consultation/'; // TODO: замените на финальный slug страницы.
$PAGE_TITLE = 'Персональная консультация по безопасной работе с криптоактивами';

// Вычисляем базовый путь до ассетов относительно текущего скрипта.
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/local_draft/consultation/index.php'));
$scriptDir = $scriptDir === '.' ? '' : rtrim($scriptDir, '/');
$assetBase = $scriptDir . '/assets';

$headerPath = ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/bitrix/header.php';
$footerPath = ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/bitrix/footer.php';
$hasBitrixFiles = is_file($headerPath) && is_file($footerPath);
$bitrixMode = false;

// Если файл запускается внутри Bitrix-окружения, подключаем системный header.
if ($hasBitrixFiles && !defined('B_PROLOG_INCLUDED')) {
    require $headerPath;
}

if (defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED === true && isset($APPLICATION)) {
    $bitrixMode = true;
    $APPLICATION->SetTitle($PAGE_TITLE);
    $APPLICATION->SetPageProperty('description', 'Персональная консультация по безопасной работе с криптоактивами для пользователей, инвесторов, предпринимателей и команд.');
    $APPLICATION->SetPageProperty('keywords', 'криптовалюта, консультация, безопасность, криптоактивы');
    $APPLICATION->SetAdditionalCSS($assetBase . '/style.css');
    $APPLICATION->AddHeadScript($assetBase . '/script.js');
}
?>
<?php if (!$bitrixMode): ?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($PAGE_TITLE, ENT_QUOTES) ?></title>
  <meta name="description" content="Персональная консультация по безопасной работе с криптоактивами для пользователей, инвесторов, предпринимателей и команд.">
  <link rel="canonical" href="<?= htmlspecialchars($PAGE_SLUG, ENT_QUOTES) ?>">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES) ?>/style.css">
</head>
<body>
<?php endif; ?>

<main class="consult-page" data-page-slug="<?= htmlspecialchars($PAGE_SLUG, ENT_QUOTES) ?>">
  <div class="container">
    <section class="hero" id="top">
      <div class="hero__content">
        <p class="hero__label" aria-hidden="true"></p>
        <h1 class="hero__title">Поможем безопасно разобраться с&nbsp;криптоактивами за&nbsp;60 минут</h1>
        <p class="hero__text">Персональная консультация для обычных пользователей, инвесторов, предпринимателей и&nbsp;команд. Покажем риски, объясним всё простым языком и&nbsp;дадим понятный план действий.</p>
        <div class="hero__actions">
          <button class="btn btn--primary" type="button" data-scroll-to="#consult-form-section">Получить персональный план</button>
          <button class="btn btn--ghost" type="button" data-scroll-to="#workflow">Выбрать время консультации</button>
        </div>
      </div>
      <div class="hero__media" aria-hidden="true"></div>
    </section>

    <section class="section section--metrics" id="metrics">
      <div class="metrics-grid">
        <article class="metric-item">
          <strong>60 мин</strong>
          <span>Предметная консультация</span>
        </article>
        <article class="metric-item">
          <strong>Формат</strong>
          <span>Онлайн или офлайн</span>
        </article>
        <article class="metric-item">
          <strong>Разбор</strong>
          <span>Персональный подход</span>
        </article>
        <article class="metric-item">
          <strong>NDA</strong>
          <span>Конфиденциальность</span>
        </article>
      </div>
    </section>


    <section class="section section--light" id="benefits">
      <h2 class="section__title">Что вы получите после консультации</h2>
      <p class="section__lead">Без сложных терминов и&nbsp;лишней теории.</p>
      <!-- Компоновка оставлена прежней: две боковые колонки + центральный фокус-блок. -->
      <div class="benefits-layout">
        <div class="benefits-layout__col">
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--lock" aria-hidden="true"></span>
            <h3>Поймете свою текущую ситуацию</h3>
            <p>Увидите, что уже работает нормально, а&nbsp;где нужна корректировка.</p>
          </article>
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--user" aria-hidden="true"></span>
            <h3>Увидите основные риски</h3>
            <p>Определим, что важно закрыть в&nbsp;первую очередь.</p>
          </article>
        </div>

        <article class="benefit-focus">
          <h3>Итог<br>сессии</h3>
          <div class="benefit-focus__photo" aria-hidden="true"></div>
          <div class="benefit-focus__art">
            <div class="benefit-focus__checklist">
              <div class="benefit-focus__checklist-item"><span class="benefit-focus__check">✓</span><span>Анализ вашей ситуации</span></div>
              <div class="benefit-focus__checklist-item"><span class="benefit-focus__check">✓</span><span>Выявленные риски</span></div>
              <div class="benefit-focus__checklist-item"><span class="benefit-focus__check">✓</span><span>План действий</span></div>
            </div>
          </div>
        </article>

        <div class="benefits-layout__col">
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--box" aria-hidden="true"></span>
            <h3>Получите рекомендации по&nbsp;делу</h3>
            <p>Сфокусируемся на&nbsp;шагах, которые можно внедрить сразу.</p>
          </article>
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--gear" aria-hidden="true"></span>
            <h3>Уйдете с&nbsp;планом действий</h3>
            <p>Закрепим последовательность шагов на ближайший период.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section" id="workflow">
      <h2 class="section__title">Как всё проходит</h2>
      <div class="steps-grid">
        <article class="step-card">
          <span class="step-card__index">01</span>
          <h3>Оставляете заявку</h3>
          <p>Коротко пишете, что хотите разобрать.</p>
        </article>
        <article class="step-card step-card--with-media">
          <span class="step-card__index">02</span>
          <h3>Выбираете удобное время</h3>
          <p>Согласовываем формат и&nbsp;слот для встречи онлайн или офлайн.</p>
          <div class="step-card__calendar" aria-hidden="true">
            <div class="step-card__calendar-head">
              <span>‹</span>
              <strong>Январь</strong>
              <span>›</span>
            </div>
            <div class="step-card__calendar-week">
              <span>Пн</span>
              <span>Вт</span>
              <span>Ср</span>
              <span>Чт</span>
              <span>Пт</span>
            </div>
            <div class="step-card__calendar-days">
              <span>8</span>
              <span>9</span>
              <span class="is-active">10</span>
              <span>11</span>
              <span>12</span>
            </div>
          </div>
        </article>
        <article class="step-card step-card--with-media">
          <span class="step-card__index">03</span>
          <h3>При необходимости готовите материалы</h3>
          <p>Подскажем, что лучше прислать заранее.</p>
          <div class="step-card__booking" aria-hidden="true">
            <div class="step-card__booking-status">Сессия забронирована</div>
            <div class="step-card__booking-row">
              <span>Пятница, 9 января</span>
              <span>11:00 (UTC +1)</span>
            </div>
            <div class="step-card__booking-chip">Перенести</div>
            <div class="step-card__booking-note">Изменение времени доступно не позднее чем за&nbsp;72 часа до&nbsp;сессии</div>
          </div>
        </article>
        <article class="step-card">
          <span class="step-card__index">04</span>
          <h3>Получаете разбор и&nbsp;рекомендации</h3>
          <p>Обсуждаем вашу ситуацию и&nbsp;фиксируем следующие шаги.</p>
        </article>
      </div>
    </section>

    <section class="section section--light" id="prep">
      <h2 class="section__title">Что важно знать до встречи</h2>
      <p class="section__lead">Никакой сложной подготовки. Мы подскажем, что полезно заранее продумать, и&nbsp;не будем перегружать вас техническими деталями.</p>
      <div class="prep-grid">
        <article class="prep-card">
          <span class="prep-card__icon prep-card__icon--format" aria-hidden="true"></span>
          <h3>Можно онлайн или&nbsp;офлайн</h3>
          <p>Подберём формат встречи под вашу задачу и&nbsp;удобный для вас сценарий.</p>
        </article>
        <article class="prep-card">
          <span class="prep-card__icon prep-card__icon--learn" aria-hidden="true"></span>
          <h3>Не нужны глубокие знания</h3>
          <p>Объясняем всё простым языком и&nbsp;подстраиваемся под ваш уровень.</p>
        </article>
        <article class="prep-card">
          <span class="prep-card__icon prep-card__icon--privacy" aria-hidden="true"></span>
          <h3>Не запрашиваем секретные данные</h3>
          <p>Seed-фразы, приватные ключи и&nbsp;коды доступа не&nbsp;нужно передавать.</p>
        </article>
      </div>
    </section>

    <section class="section section--light" id="session-scenes">
      <h2 class="section__title">Как выглядит консультация на практике</h2>
      <p class="section__lead">Спокойный рабочий формат: разбираем вашу ситуацию, фиксируем риски и&nbsp;сразу переводим разговор в&nbsp;понятные следующие шаги.</p>
      <div class="scene-grid">
        <article class="scene-card scene-card--analysis">
          <div class="scene-card__media scene-card__media--analysis" aria-hidden="true"></div>
          <div class="scene-card__body">
            <h3>Разбираем вашу текущую схему</h3>
            <p>Смотрим, как сейчас устроены хранение, доступы и&nbsp;рабочие привычки.</p>
          </div>
        </article>
        <article class="scene-card scene-card--personal">
          <div class="scene-card__media scene-card__media--personal" aria-hidden="true"></div>
          <div class="scene-card__body">
            <h3>Подстраиваемся под ваш контекст</h3>
            <p>Личный сценарий, инвестиции или рабочие задачи&nbsp;— говорим именно о&nbsp;вашем кейсе.</p>
          </div>
        </article>
        <article class="scene-card scene-card--team">
          <div class="scene-card__media scene-card__media--team" aria-hidden="true"></div>
          <div class="scene-card__body">
            <h3>Фиксируем роли, риски и&nbsp;шаги</h3>
            <p>Если в&nbsp;процессе участвует команда, отдельно смотрим доступы, роли и&nbsp;контроль.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="section" id="diagnostics">
      <!-- Единый блок вместо двух похожих секций: и про запросы пользователя, и про предмет консультации. -->
      <div class="diagnostics-layout">
        <div class="diagnostics-layout__intro">
          <h2 class="section__title diagnostics-layout__title">Что можно разобрать на&nbsp;консультации</h2>
          <p class="section__lead diagnostics-layout__lead">Поможем навести порядок, понять риски и&nbsp;определить следующие шаги.</p>
        </div>
        <div class="diagnostics-grid">
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--storage" aria-hidden="true"></span>
            <p>Как сейчас организовано хранение активов.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--access" aria-hidden="true"></span>
            <p>Насколько безопасно настроены доступы.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--risk" aria-hidden="true"></span>
            <p>Где есть лишние риски и&nbsp;уязвимости.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--chaos" aria-hidden="true"></span>
            <p>Что делать, если всё уже устроено хаотично.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--steps" aria-hidden="true"></span>
            <p>Какие шаги помогут выстроить более надежную схему.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon diagnostics-item__icon--start" aria-hidden="true"></span>
            <p>С чего начать, если пока нет системы.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section section--light" id="consult-form-section">
      <h2 class="section__title">Запишитесь на&nbsp;консультацию</h2>
      <p class="section__lead">Оставьте контакты&nbsp;— свяжемся с&nbsp;вами, уточним задачу и&nbsp;предложим удобное время.</p>

      <?php if ($bitrixMode && $CONSULT_FORM_ID > 0): ?>
        <?php
        // Подключение штатной веб-формы Bitrix. WEB_FORM_ID берется из переменной $CONSULT_FORM_ID.
        $APPLICATION->IncludeComponent(
            'bitrix:form.result.new',
            '',
            array(
                'WEB_FORM_ID' => (string)$CONSULT_FORM_ID,
                'IGNORE_CUSTOM_TEMPLATE' => 'N',
                'USE_EXTENDED_ERRORS' => 'N',
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => '3600',
                'SEF_MODE' => 'N',
                'LIST_URL' => '',
                'EDIT_URL' => '',
                'SUCCESS_URL' => '',
                'CHAIN_ITEM_TEXT' => '',
                'CHAIN_ITEM_LINK' => '',
                'VARIABLE_ALIASES' => array(
                    'WEB_FORM_ID' => 'WEB_FORM_ID',
                    'RESULT_ID' => 'RESULT_ID',
                ),
            )
        );
        ?>
      <?php else: ?>
        <form class="consult-form consult-form--mock" id="consult-form" novalidate>
          <div class="consult-form__chips" aria-hidden="true">
            <span class="consult-form__chip">Ответ в&nbsp;течение 15 минут</span>
            <span class="consult-form__chip">Конфиденциально</span>
          </div>
          <div class="consult-form__row">
            <label class="consult-form__field">
              <input type="text" name="name" placeholder="Ваше имя" aria-label="Ваше имя" required>
            </label>
            <label class="consult-form__field">
              <input type="tel" name="phone" placeholder="Телефон / Telegram" aria-label="Телефон / Telegram" required>
            </label>
          </div>
          <label class="consult-form__consent">
            <input type="checkbox" name="consent" required>
            <span>Я согласен с&nbsp;<a href="/company/consent/" target="_blank" rel="noopener noreferrer">обработкой персональных данных</a></span>
          </label>
          <button class="btn btn--primary btn--full btn--with-hex" type="submit">
            <span class="btn__label">Получить персональный план</span>
            <span class="btn__hex-icon" aria-hidden="true">↗</span>
          </button>
          <p class="consult-form__microtext">Подходит и&nbsp;новичкам, и&nbsp;тем, кто уже пользуется криптой.</p>
          <p class="consult-form__result" data-form-result hidden></p>
        </form>
      <?php endif; ?>
    </section>

    <section class="section" id="faq">
      <h2 class="section__title">Частые вопросы</h2>
      <div class="faq" data-faq>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question faq-question" type="button" aria-expanded="true">
            <span class="faq-item__head">
              <span class="faq-item__index">01</span>
              <span class="faq-item__title">Сколько длится консультация?</span>
            </span>
            <span class="faq-item__toggle" data-index="01" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer faq-answer">
            <p>Обычно 60 минут. Этого достаточно, чтобы понять вашу ситуацию, увидеть основные риски и&nbsp;определить следующие шаги.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question faq-question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">02</span>
              <span class="faq-item__title">Подходит ли это новичкам?</span>
            </span>
            <span class="faq-item__toggle" data-index="02" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer faq-answer" hidden>
            <p>Да. Не нужно быть экспертом или&nbsp;глубоко разбираться в&nbsp;технических деталях. Мы объясняем всё простым языком и&nbsp;подстраиваемся под ваш уровень.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question faq-question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">03</span>
              <span class="faq-item__title">Что я получу по&nbsp;итогам?</span>
            </span>
            <span class="faq-item__toggle" data-index="03" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer faq-answer" hidden>
            <p>Вы получите разбор вашей ситуации, рекомендации и&nbsp;понятный план действий без лишней воды.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question faq-question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">04</span>
              <span class="faq-item__title">Есть ли смысл идти, если пока всё хаотично?</span>
            </span>
            <span class="faq-item__toggle" data-index="04" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer faq-answer" hidden>
            <p>Да. Очень часто на консультацию приходят именно с&nbsp;этим запросом: ничего не&nbsp;сломано, но всё непонятно и&nbsp;тревожно. Мы помогаем навести порядок.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question faq-question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">05</span>
              <span class="faq-item__title">Консультация проходит онлайн?</span>
            </span>
            <span class="faq-item__toggle" data-index="05" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer faq-answer" hidden>
            <p>Да, консультация проходит онлайн.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="section section--pricing" id="pricing">
      <div class="pricing">
        <div class="pricing__main">
          <h2 class="section__title section__title--white">Персональная консультация<br>по безопасной работе<br>с криптоактивами</h2>
          <p class="pricing__description">60 минут предметного разбора для обычных пользователей, инвесторов, предпринимателей и&nbsp;команд.</p>
          <p class="pricing__price">от 4 900 ₽</p>
        </div>
        <div class="pricing__included">
          <p class="pricing__label">Что входит</p>
          <ul class="pricing__list">
            <li>Разбор вашей текущей ситуации</li>
            <li>Выявление основных рисков</li>
            <li>Практические рекомендации</li>
            <li>Понятный план дальнейших действий</li>
          </ul>
        </div>
      </div>

    </section>

  </div>
</main>

<?php if (!$bitrixMode): ?>
  <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES) ?>/script.js" defer></script>
</body>
</html>
<?php else: ?>
  <?php require $footerPath; ?>
<?php endif; ?>
