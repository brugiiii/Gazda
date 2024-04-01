<?php
$vacancies = get_field('cards');
?>

<section class="section vacancies">
    <h2 class="visually-hidden">
        Вакансії
    </h2>
    <div class="container">
        <ul class="vacancies-list d-flex flex-wrap">
            <?php
            foreach ($vacancies as $vacancy) {
                $position = $vacancy['position'];
                $salary = $vacancy['salary'];
                ?>
                <li class="vacancies-list__item d-flex flex-column position-relative rounded-4">
                    <h3 class="vacancies-list__position mb-2 text-uppercase fw-semibold">
                        <?= $position; ?>
                    </h3>
                    <p class="vacancies-list__salary mb-auto text-uppercase fw-light">
                        <?= $salary; ?>
                    </p>
                    <span class="vacancies-list__details fw-semibold d-flex align-items-center gap-2">
                        Детальніше
                        <svg class="vacancies-list__icon" width="24" height="24">
                            <use href="<?php get_image('sprite.svg#icon-caret-right'); ?>"></use>
                        </svg>
                    </span>
                    <button type="button"
                            class="vacancies-list__button position-absolute top-0 start-0 end-0 bottom-0 bg-transparent p-0 border-0"
                            data-title="<?= 'Відгук на вакансію: ' . $position . ' ' . $salary; ?>"
                            data-position="<?= $position; ?>"></button>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</section>