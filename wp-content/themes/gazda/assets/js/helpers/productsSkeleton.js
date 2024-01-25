export const productsSkeleton = `
    <div class="products-list d-flex flex-wrap">
        ${Array(8).fill(`
            <div class="skeleton-list__item products-list__item">
            </div>`).join('')}
    </div>`;