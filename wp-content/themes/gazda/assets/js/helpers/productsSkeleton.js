export const productsSkeleton = (count = 12) => {
    return `${Array(count)
        .fill(`
            <li class="skeleton-list__item product">
            </li>`)
        .join('')}`
}
