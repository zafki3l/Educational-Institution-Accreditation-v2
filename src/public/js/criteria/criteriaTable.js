document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        const standardId = btn.dataset.standardId;

        const saved = localStorage.getItem(`standard-${standardId}-expanded`);
        const expanded = saved !== 'false';

        btn.setAttribute('aria-expanded', String(expanded));
        toggleRows(standardId, expanded);

        btn.addEventListener('click', e => {
            e.preventDefault();

            const isExpanded =
                btn.getAttribute('aria-expanded') === 'true';

            const nextState = !isExpanded;
            btn.setAttribute('aria-expanded', String(nextState));

            toggleRows(standardId, nextState);
            localStorage.setItem(
                `standard-${standardId}-expanded`,
                String(nextState)
            );
        });
    });

    function toggleRows(standardId, expanded) {
        document
            .querySelectorAll(
                `.criteria-row[data-parent-standard="${standardId}"]`
            )
            .forEach(row => {
                row.style.display = expanded ? '' : 'none';
            });
    }
});

document.querySelectorAll('.criteria-name').forEach(el => {
    el.addEventListener('click', () => {
        el.classList.toggle('expanded');
    });
});