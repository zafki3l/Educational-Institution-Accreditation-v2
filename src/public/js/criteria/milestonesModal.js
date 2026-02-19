async function fetchMilestones(criteriaId) {
    const res = await fetch(`/criterias/${criteriaId}/milestones`);
    if (!res.ok) {
        throw new Error(`HTTP error! status: ${res.status}`);
    }
    try {
        const data = await res.json();
        return data.criteria.milestones ?? [];
    } catch (parseError) {
        throw new Error(`Invalid JSON response: ${parseError.message}`);
    }
}

document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.milestone-btn');
    if (!btn) return;

    e.preventDefault();

    document.getElementById('milestonesModalDesc').textContent = btn.dataset.desc || 'Chưa có mô tả';

    const criteriaId = btn.dataset.id;
    try {
        const milestones = await fetchMilestones(criteriaId);
        renderMilestonesTable(milestones);
        openMilestonesModal();
    } catch (error) {
        console.error('Error fetching milestones:', error);
        alert('Không thể tải mốc đánh giá. Vui lòng thử lại.');
    }
});

function renderMilestonesTable(milestones) {
    const tbody = document.getElementById('milestonesTableBody');
    const emptyState = document.getElementById('emptyMilestonesState');

    if (!milestones.length) {
        tbody.innerHTML = '';
        emptyState.style.display = 'block';
        return;
    }

    emptyState.style.display = 'none';

    tbody.innerHTML = milestones.map(m => `
        <tr>
            <td>#${m.id}</td>
            <td>${escapeHtml(m.name)}</td>
            <td class="right">
                <div class="action-group">
                    <button class="icon-btn edit-milestone-btn"
                            type="button"
                            title="Chỉnh sửa"
                            data-id="<?= $milestone->id ?>">
                        <span class="material-symbols-outlined">edit</span>
                    </button>

                    <button class="icon-btn danger delete-milestone-btn"
                            type="button"
                            title="Xóa"
                            data-id="<?= $milestone->id ?>"
                            data-name="<?= htmlspecialchars($milestone->name) ?>">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function openMilestonesModal() {
    document.getElementById('milestonesModal').classList.add('show');
}

function closeMilestonesModal() {
    document.getElementById('milestonesModal').classList.remove('show');
}

function escapeHtml(text) {
    return text.replace(/[&<>"']/g, c => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    })[c]);
}
document.getElementById('closeMilestonesModal')
    ?.addEventListener('click', closeMilestonesModal);

document.getElementById('closeMilestonesBtn')
    ?.addEventListener('click', closeMilestonesModal);

document.querySelector('#milestonesModal .modal-overlay')
    ?.addEventListener('click', closeMilestonesModal);