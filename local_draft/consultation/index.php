<?php
/**
 * Локальный черновик посадочной страницы консультации.
 * Важно: это автономный шаблон для согласования структуры до интеграции в рабочий Bitrix-проект.
 */

$CONSULT_FORM_ID = 0; // TODO: замените на реальный ID веб-формы в Bitrix.
$PRIVACY_URL = '/privacy-policy/'; // TODO: замените на фактический URL политики конфиденциальности.
$PAGE_SLUG = '/consultation/'; // TODO: замените на финальный slug страницы.
$PAGE_TITLE = 'Безопасная система работы с криптоактивами за 60 минут';

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
    $APPLICATION->SetPageProperty('description', 'Практическая консультация по безопасной работе с криптоактивами: стратегия, риски, маршрут действий.');
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
  <meta name="description" content="Практическая консультация по безопасной работе с криптоактивами: стратегия, риски, маршрут действий.">
  <link rel="canonical" href="<?= htmlspecialchars($PAGE_SLUG, ENT_QUOTES) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES) ?>/style.css">
</head>
<body>
<?php endif; ?>

<main class="consult-page" data-page-slug="<?= htmlspecialchars($PAGE_SLUG, ENT_QUOTES) ?>">
  <div class="container">
    <section class="hero" id="top">
      <div class="hero__content">
        <p class="hero__label" aria-hidden="true"></p>
        <h1 class="hero__title">Безопасная система работы с криптоактивами за 60 минут</h1>
        <p class="hero__text">Итог консультации: персональный план действий и понятная схема защиты активов.</p>
        <div class="hero__actions">
          <button class="btn btn--primary" type="button" data-scroll-to="#consult-form-section">Получить персональный план</button>
          <button class="btn btn--ghost" type="button" data-scroll-to="#workflow">Выбрать формат сессии</button>
        </div>
      </div>
      <div class="hero__media" aria-hidden="true"></div>
    </section>

    <section class="section section--light" id="benefits">
      <h2 class="section__title">Как помогает консультация</h2>
      <!-- Компоновка как в макете: две боковые колонки + центральный фокус-блок. -->
      <div class="benefits-layout">
        <div class="benefits-layout__col">
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--lock" aria-hidden="true">⌂</span>
            <h3>Системно и спокойно</h3>
            <p>Выстраиваем понятную схему защиты активов без перегруза и лишних шагов.</p>
          </article>
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--user" aria-hidden="true">◌</span>
            <h3>Персональный подход</h3>
            <p>Разбираем именно ваш кейс и даем приоритеты, которые можно применить сразу.</p>
          </article>
        </div>

        <article class="benefit-focus">
          <h3>Безопасность<br>в фокусе</h3>
          <div class="benefit-focus__inner">
            Ваш план действий<br>после сессии
          </div>
        </article>

        <div class="benefits-layout__col">
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--box" aria-hidden="true">⌁</span>
            <h3>Опыт экспертов</h3>
            <p>Показываем рабочие практики и проверенные сценарии, применимые в реальной работе.</p>
          </article>
          <article class="benefit-side">
            <span class="benefit-side__icon benefit-side__icon--gear" aria-hidden="true">◍</span>
            <h3>Для любого уровня</h3>
            <p>Подходит и новичкам, и опытным пользователям: сложное объясняем простым языком.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section" id="workflow">
      <h2 class="section__title">Как это работает</h2>
      <div class="steps-grid">
        <article class="step-card">
          <span class="step-card__index">01</span>
          <h3>Оставляете заявку</h3>
          <p>Фиксируем задачу, формат и удобное время консультации.</p>
        </article>
        <article class="step-card step-card--with-media">
          <span class="step-card__index">02</span>
          <h3>Бронируете время</h3>
          <p>Выбираете дату и время в удобном формате без переписки туда-сюда.</p>
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
          <h3>Подтверждаете слот</h3>
          <p>Получаете подтверждение и напоминание перед встречей.</p>
          <div class="step-card__booking" aria-hidden="true">
            <div class="step-card__booking-status">Сессия забронирована</div>
            <div class="step-card__booking-row">
              <span>Пятница, 9 января</span>
              <span>11:00 (UTC +1)</span>
            </div>
            <div class="step-card__booking-chip">Перенести</div>
            <div class="step-card__booking-note">Изменение времени доступно не позднее чем за 72 часа до сессии</div>
          </div>
        </article>
        <article class="step-card">
          <span class="step-card__index">04</span>
          <h3>Проводим сессию</h3>
          <p>Встречаемся онлайн и выдаем четкий план действий по вашему кейсу.</p>
        </article>
      </div>
    </section>

    <section class="section section--light" id="audience">
      <h2 class="section__title">Кому подходит консультация</h2>
      <p class="section__lead">Выберите свой сценарий: персональный, предпринимательский или командный.</p>
      <div class="audience-grid">
        <article class="audience-card audience-card--investor">
          <h3>Частным инвесторам</h3>
          <p>Если хотите уверенно хранить активы, снизить риски и выстроить понятный личный процесс.</p>
          <div class="audience-card__media audience-card__media--investor" aria-hidden="true"></div>
        </article>
        <article class="audience-card audience-card--business">
          <h3>Предпринимателям</h3>
          <p>Если нужны правила доступа, контроль операций и безопасная работа с цифровыми активами в бизнесе.</p>
          <div class="audience-card__media audience-card__media--business" aria-hidden="true"></div>
        </article>
        <article class="audience-card audience-card--teams audience-card--light">
          <h3>Командам и проектам</h3>
          <p>Если важны роли, процессы и масштабируемая система безопасности без ручного хаоса.</p>
          <div class="audience-card__media audience-card__media--teams" aria-hidden="true"></div>
        </article>
      </div>
    </section>

    <section class="section" id="diagnostics">
      <!-- Компоновка как в макете: крупный заголовок слева и карточки-пункты справа. -->
      <div class="diagnostics-layout">
        <h2 class="section__title diagnostics-layout__title">Что проверяем и что подготовить</h2>
        <div class="diagnostics-grid">
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">◌</span>
            <p>Проверяем хранение активов и устойчивость схемы доступа.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">⌁</span>
            <p>Фиксируем роли и права, чтобы исключить лишние риски.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">↻</span>
            <p>Сверяем резервные сценарии и порядок восстановления.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">≡</span>
            <p>Подбираем инструменты по задачам без переплаты.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">▣</span>
            <p>Заранее сформулируйте цели и ваш рабочий контекст.</p>
          </article>
          <article class="diagnostics-item">
            <span class="diagnostics-item__icon" aria-hidden="true">⚠</span>
            <p>Соберите ограничения, чтобы быстрее выйти на решение.</p>
          </article>
          <article class="diagnostics-item diagnostics-item--wide">
            <span class="diagnostics-item__icon" aria-hidden="true">⤴</span>
            <p>Подготовьте текущую схему и список вопросов к разбору.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section section--light" id="consult-form-section">
      <h2 class="section__title">Форма записи</h2>
      <p class="section__lead">Оставьте контакты и кратко опишите задачу. Мы предложим удобное время и формат консультации.</p>

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
            <span class="consult-form__chip">Ответ в течение 15 минут</span>
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
          <button class="btn btn--primary btn--full btn--with-hex" type="submit">
            <span class="btn__label">Получить персональный план</span>
            <span class="btn__hex-icon" aria-hidden="true">↗</span>
          </button>
          <p class="consult-form__result" data-form-result hidden></p>
        </form>
      <?php endif; ?>
    </section>

    <section class="section" id="faq">
      <h2 class="section__title">Частые вопросы</h2>
      <div class="faq" data-faq>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="true">
            <span class="faq-item__head">
              <span class="faq-item__index">01</span>
              <span class="faq-item__title">Сколько длится консультация?</span>
            </span>
            <span class="faq-item__toggle" data-index="01" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer">
            <p>60 минут. По итогу вы получаете приоритетный план действий и рекомендации по инструментам.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">02</span>
              <span class="faq-item__title">Онлайн или офлайн?</span>
            </span>
            <span class="faq-item__toggle" data-index="02" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Базовый формат — онлайн-созвон. Офлайн встречи обсуждаются отдельно.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">03</span>
              <span class="faq-item__title">Что вы получите по итогу?</span>
            </span>
            <span class="faq-item__toggle" data-index="03" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Персональный маршрут действий, список рисков и конкретные следующие шаги по вашей ситуации.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span class="faq-item__head">
              <span class="faq-item__index">04</span>
              <span class="faq-item__title">Можно ли после сессии сопровождение?</span>
            </span>
            <span class="faq-item__toggle" data-index="04" aria-hidden="true"></span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Да, при необходимости подключаем формат сопровождения с отдельным графиком и SLA.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="section section--pricing" id="pricing">
      <div class="pricing">
        <div class="pricing__main">
          <h2 class="section__title section__title--white">Стоимость<br>и формат</h2>
          <p class="pricing__description">Экспертная сессия — 60 минут онлайн.<br>Итог: персональный план внедрения, схема защиты активов и рекомендации по инструментам.<br>После сессии: возможность подключить сопровождение по отдельному тарифу.</p>
          <p class="pricing__price">от 4 900 ₽</p>
        </div>
        <div class="pricing__included">
          <p class="pricing__label">Что входит в сессию</p>
          <ul class="pricing__list">
            <li>Аудит текущего хранения активов</li>
            <li>Персональный план защиты</li>
            <li>Рекомендации по инструментам</li>
            <li>Запись и материалы после сессии</li>
          </ul>
        </div>
      </div>

    </section>

    <section class="section section--metrics" id="metrics">
      <div class="metrics-grid">
        <article class="metric-item">
          <strong>200+</strong>
          <span>Сессий проведено</span>
        </article>
        <article class="metric-item">
          <strong>98%</strong>
          <span>Клиентов рекомендуют</span>
        </article>
        <article class="metric-item">
          <strong>60 мин</strong>
          <span>Чёткий результат за сессию</span>
        </article>
        <article class="metric-item">
          <strong>NDA</strong>
          <span>Конфиденциальность</span>
        </article>
      </div>
    </section>

    <section class="section section--cta" id="cta">
      <h2 class="section__title section__title--white">Есть вопросы перед записью?</h2>
      <p class="section__lead section__lead--white">Напишите или позвоните — разберём вашу ситуацию и подберём формат консультации.</p>
      <div class="cta__actions">
        <a class="btn btn--telegram btn--with-hex" href="https://t.me/cryptoro" target="_blank" rel="noopener noreferrer">
          <span class="btn__label">Написать в Telegram</span>
          <span class="btn__hex-icon" aria-hidden="true">↗</span>
        </a>
        <a class="btn btn--contact" href="tel:+74951918174">+7 495 191-81-74</a>
        <a class="btn btn--contact" href="mailto:shop@cryptoro.ru">shop@cryptoro.ru</a>
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
