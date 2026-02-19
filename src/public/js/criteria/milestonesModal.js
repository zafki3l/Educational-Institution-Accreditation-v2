// Fake milestone data
const milestonesData = {
    1: [
        { id: 1, name: 'CSGD có tuyên bố chính thức về tầm nhìn, sứ mạng.', score: 50, description: 'Đáp ứng các yêu cầu cơ bản của tiêu chí' },
        { id: 2, name: 'Có sự tham gia của các bên liên quan cán bộ quản lý, GV, NH, nhà sử dụng lao động, các tổ chức xã hội-nghề nghiệp, ...) trong quá trình xây dựng tầm nhìn, sứ mạng.', score: 75, description: 'Vượt quá yêu cầu cơ bản, có chất lượng tốt' },
        { id: 3, name: 'Hoàn thành xuất sắc', score: 100, description: 'Đáp ứng tất cả các yêu cầu với chất lượng cao' }
    ],
    2: [
        { id: 1, name: 'Đạt mức độ thấp', score: 40, description: 'Đáp ứng mức độ tối thiểu' },
        { id: 2, name: 'Đạt mức độ trung bình', score: 70, description: 'Đáp ứng mức độ trung bình' },
        { id: 3, name: 'Đạt mức độ cao', score: 100, description: 'Vượt quá mức độ cao nhất' }
    ],
    3: [
        { id: 1, name: 'Chưa đủ', score: 25, description: 'Chưa đáp ứng yêu cầu' },
        { id: 2, name: 'Đủ', score: 60, description: 'Đáp ứng đủ yêu cầu' },
        { id: 3, name: 'Vượt chỉ tiêu', score: 100, description: 'Vượt quá mong đợi' }
    ]
};

let currentCriteriaId = null;

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.milestone-btn').forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            currentCriteriaId = Math.min(index + 1, 3);
            renderMilestonesTable();
            openMilestonesModal();
        });
    });

    document.getElementById('closeMilestonesModal').onclick =
    document.getElementById('closeMilestonesBtn').onclick =
        closeMilestonesModal;

    document.querySelector('.modal-overlay').onclick = closeMilestonesModal;
});

function renderMilestonesTable() {
    const tbody = document.getElementById('milestonesTableBody');
    const emptyState = document.getElementById('emptyMilestonesState');
    const milestones = milestonesData[currentCriteriaId] || [];

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
                <span class="material-symbols-outlined">edit</span>
                <span class="material-symbols-outlined">delete</span>
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