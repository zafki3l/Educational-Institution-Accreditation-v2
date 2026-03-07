<div class="stats-header">
    <h3>Thống kê hệ thống</h3>
    <div class="filter-buttons">
        <button>7 ngày qua</button>
        <button class="active">Tháng này</button>
    </div>
</div>

<div class="stats-grid">
    <div class="stats-card large">
        <div class="stats-card-header">
            <div>
                <h4>Thống kê số lượng tiêu chuẩn theo phòng ban quản lý</h4>
            </div>
        </div>

        <div id="custom-bar-chart-container" class="custom-bar-chart">
        </div>
    </div>
</div>

<script>
    fetch('/api/departments/standards')
.then(res => res.json())
.then(data => {

    const container = document.getElementById('custom-bar-chart-container');
    if (!data.department || data.department.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #94a3b8; padding: 20px;">Chưa có dữ liệu</p>';
        return;
    }

    const maxVal = Math.max(...data.department.map(d => d.standards_count), 8); 
    const tickCount = 8;
    const roundedMax = Math.ceil(maxVal / tickCount) * tickCount; 

    let yAxisHtml = '<div class="chart-y-axis">';
    for(let i=0; i<=tickCount; i++) {
        const val = Math.round((roundedMax / tickCount) * i);
        const bottomPct = (i / tickCount) * 100;
        yAxisHtml += `<div class="chart-y-tick" style="position: absolute; bottom: ${bottomPct}%; right: 16px; transform: translateY(50%);">${val}</div>`;
    }
    yAxisHtml += '</div>';

    let gridHtml = '<div class="chart-main-area"><div class="chart-grid-bg" aria-hidden="true">';
    for(let i=0; i<tickCount; i++) {
        gridHtml += '<div class="chart-grid-line"></div>';
    }
    gridHtml += '<div class="chart-grid-line last"></div></div>';

    let barsHtml = '<div class="chart-bars-container" id="chart-body">';
    window.chartTooltipData = {}; 

    data.department.forEach((d, idx) => {
        const pct = (d.standards_count / roundedMax) * 100;
        const ttKey = 'dept_' + idx;
        window.chartTooltipData[ttKey] = d;

        let deptCode = d.department_id || d.id; 
        if (!deptCode) {
            deptCode = 'P' + (idx + 1);
        }

        barsHtml += `
            <div class="chart-col" data-tooltip-key="${ttKey}">
                <div class="chart-track">
                    <div class="chart-bar-fill" style="height: 0%;" data-height="${pct}%">
                        <span class="chart-bar-value">${d.standards_count}</span>
                    </div>
                </div>
                <div class="chart-col-label" title="${d.name}">${deptCode}</div>
            </div>
        `;
    });
    barsHtml += '</div></div>';

    container.innerHTML = yAxisHtml + gridHtml + barsHtml;

    let tooltip = document.getElementById('chart-tooltip');
    if (!tooltip) {
        tooltip = document.createElement('div');
        tooltip.id = 'chart-tooltip';
        document.body.appendChild(tooltip);
    }

    const cols = container.querySelectorAll('.chart-col');
    cols.forEach(col => {
        col.addEventListener('mouseenter', (e) => {
            const key = col.getAttribute('data-tooltip-key');
            const deptData = window.chartTooltipData[key];
            if (!deptData) return;

            let standards = deptData.standards || [];
            
            let html = `<div class="chart-tooltip-title">${deptData.name} - ${deptData.standards_count} tiêu chuẩn</div>`;
            
            if (standards.length > 0) {
                html += '<ul class="chart-tooltip-list">';
                const limit = 6;
                const shown = standards.slice(0, limit);
                shown.forEach(s => {
                    html += `<li>${s.name}</li>`;
                });
                html += '</ul>';
                
                if (standards.length > limit) {
                    html += `<div class="chart-tooltip-more">+ ${standards.length - limit} tiêu chuẩn khác...</div>`;
                }
            } else {
                html += '<div style="color: #94a3b8">Không có tiêu chuẩn nào</div>';
            }

            tooltip.innerHTML = html;
            tooltip.classList.add('visible');
        });

        col.addEventListener('mousemove', (e) => {
            let x = e.pageX + 15;
            let y = e.pageY + 15;
            
            if (x + 300 > window.innerWidth) {
                x = e.pageX - 315;
            }

            tooltip.style.left = x + 'px';
            tooltip.style.top = y + 'px';
        });

        col.addEventListener('mouseleave', () => {
            tooltip.classList.remove('visible');
        });
    });

    setTimeout(() => {
        const bars = container.querySelectorAll('.chart-bar-fill');
        bars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.height = bar.getAttribute('data-height');
            }, 100 * index);
        });
    }, 50);

});
</script>