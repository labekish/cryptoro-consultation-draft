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
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES) ?>/style.css">
</head>
<body>
<?php endif; ?>

<main class="consult-page" data-page-slug="<?= htmlspecialchars($PAGE_SLUG, ENT_QUOTES) ?>">
  <div class="container">
    <section class="hero" id="top">
      <div class="hero__content">
        <p class="hero__label">Первая консультация: практический план действий</p>
        <h1 class="hero__title">Безопасная система работы с криптоактивами за 60 минут</h1>
        <p class="hero__text">Соберём понятную схему входа в крипторынок и снизим операционные риски: от выбора кошелька до безопасных сценариев работы.</p>
        <div class="hero__actions">
          <button class="btn btn--primary" type="button" data-scroll-to="#consult-form-section">Получить экспертный разбор</button>
          <button class="btn btn--ghost" type="button" data-scroll-to="#workflow">Забронировать время</button>
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
          <p>Укажите имя и телефон, чтобы менеджер подтвердил детали и формат консультации.</p>
        </article>
        <article class="step-card step-card--with-media">
          <span class="step-card__index">02</span>
          <h3>Бронируете время</h3>
          <p>Выбираем удобное окно для созвона и фиксируем длительность сессии.</p>
          <div class="step-card__media step-card__media--calendar" aria-hidden="true"></div>
        </article>
        <article class="step-card step-card--with-media">
          <span class="step-card__index">03</span>
          <h3>Подтверждаете слот</h3>
          <p>Получаете напоминание и список вводных, которые лучше подготовить заранее.</p>
          <div class="step-card__media step-card__media--form" aria-hidden="true"></div>
        </article>
        <article class="step-card">
          <span class="step-card__index">04</span>
          <h3>Проводим сессию</h3>
          <p>Разбираем вашу ситуацию, фиксируем риски и итоговый маршрут действий.</p>
        </article>
      </div>
    </section>

    <section class="section section--light" id="audience">
      <h2 class="section__title">Кому подходит консультация</h2>
      <div class="audience-grid">
        <article class="audience-card audience-card--investor">
          <h3>Частным инвесторам</h3>
          <p>Для тех, кто хочет безопасно войти в крипту и не потерять деньги на первых шагах.</p>
        </article>
        <article class="audience-card audience-card--business">
          <h3>Предпринимателям</h3>
          <p>Для владельцев бизнеса, которым нужен рабочий процесс для расчётов и хранения активов.</p>
        </article>
        <article class="audience-card audience-card--teams">
          <h3>Командам и проектам</h3>
          <p>Для компаний, внедряющих криптоинструменты в операционные процессы.</p>
        </article>
      </div>
    </section>

    <section class="section" id="diagnostics">
      <h2 class="section__title">Что проверяем и что подготовить</h2>
      <ul class="check-list">
        <li>Текущие решения по входу в крипторынок, схему доступа и хранения активов.</li>
        <li>Историю операций и подход к оценке инвестиционных сценариев.</li>
        <li>Уровень инфраструктуры и готовность к безопасным масштабам.</li>
        <li>Схему верификации участников рабочей команды.</li>
        <li>Настроенную текущую схему с множественной подписью (если есть).</li>
        <li>Цели консультации, чтобы выбрать реалистичный план действий.</li>
      </ul>
    </section>

    <section class="section section--light" id="consult-form-section">
      <h2 class="section__title">Форма записи</h2>
      <p class="section__lead">Оставьте заявку, и мы предложим удобное время для первой сессии.</p>

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
          <div class="consult-form__row">
            <label class="consult-form__field">
              <span>Ваше имя</span>
              <input type="text" name="name" placeholder="Иван" required>
            </label>
            <label class="consult-form__field">
              <span>Телефон</span>
              <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required>
            </label>
          </div>
          <label class="consult-form__field">
            <span>Комментарий</span>
            <textarea name="comment" rows="4" placeholder="Кратко опишите ваш запрос"></textarea>
          </label>
          <label class="consult-form__consent">
            <input type="checkbox" name="consent" required>
            <span>Согласен на обработку персональных данных согласно <a href="<?= htmlspecialchars($PRIVACY_URL, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer">политике конфиденциальности</a>.</span>
          </label>
          <button class="btn btn--primary btn--full" type="submit">Получить экспертный разбор</button>
          <p class="consult-form__result" data-form-result hidden></p>
        </form>
      <?php endif; ?>
    </section>

    <section class="section" id="faq">
      <h2 class="section__title">Частые вопросы</h2>
      <div class="faq" data-faq>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span>Сколько длится консультация?</span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Обычно 60 минут. При необходимости можно расширить сессию до 90 минут по согласованию.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span>Онлайн или офлайн?</span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Базовый формат — онлайн-созвон. Офлайн встречи обсуждаются отдельно.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span>Что вы получите по итогу?</span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Персональный маршрут действий, список рисков и конкретные следующие шаги по вашей ситуации.</p>
          </div>
        </article>
        <article class="faq-item" data-faq-item>
          <button class="faq-item__question" type="button" aria-expanded="false">
            <span>Можно ли после сессии сопровождение?</span>
          </button>
          <div class="faq-item__answer" hidden>
            <p>Да, при необходимости подключаем формат сопровождения с отдельным графиком и SLA.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="section section--pricing" id="pricing">
      <div class="pricing">
        <div>
          <h2 class="section__title section__title--white">Стоимость и формат</h2>
          <p class="section__lead section__lead--white">Фиксированный прайс за первую консультацию и прозрачная структура встречи.</p>
          <p class="pricing__price">от 4 900 ₽</p>
        </div>
        <ul class="pricing__list">
          <li>Аудит текущих условий и точки входа</li>
          <li>Персональный план на 30 дней</li>
          <li>Рекомендации по инструментам</li>
          <li>Эскалация рисковых сценариев</li>
        </ul>
      </div>
      <div class="stats-grid">
        <article class="stat-card">
          <strong>200+</strong>
          <span>консультаций</span>
        </article>
        <article class="stat-card">
          <strong>98%</strong>
          <span>довольных клиентов</span>
        </article>
        <article class="stat-card">
          <strong>60 мин</strong>
          <span>средняя длительность</span>
        </article>
        <article class="stat-card">
          <strong>NDA</strong>
          <span>по запросу</span>
        </article>
      </div>
    </section>

    <section class="section section--cta" id="cta">
      <h2 class="section__title section__title--white">Есть вопросы перед записью?</h2>
      <p class="section__lead section__lead--white">Напишите в чат или оставьте заявку, чтобы согласовать формат первой встречи.</p>
      <div class="cta__actions">
        <button class="btn btn--primary" type="button" data-scroll-to="#consult-form-section">Оставить заявку</button>
        <a class="btn btn--ghost-light" href="mailto:info@cryptoro.ru">Написать на почту</a>
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
