const handleTabClick = (event) => {
    const target = event.target;
    const li = $(target).closest('li')[0];

    // Прокрутка контейнера до обраного елементу
    li.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
}

$(document).ready(function () {
    $('.tabs').on('click', 'li a', handleTabClick);
});
