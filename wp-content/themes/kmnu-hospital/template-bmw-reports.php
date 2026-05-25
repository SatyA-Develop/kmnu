<?php
/**
 * Template Name: BMW Reports Template
 */
get_header();

// Initial Data for First Load
$args = array(
    'post_type'      => 'bmw_reports',
    'posts_per_page' => 12,
    'meta_key'       => 'bmw_year',
    'orderby'        => 'meta_value',
    'order'          => 'DESC'
);
$report_query = new WP_Query($args);

$years = range(date('Y'), date('Y') - 5);
$months = array(
    'January', 'February', 'March', 'April', 'May', 'June', 
    'July', 'August', 'September', 'October', 'November', 'December'
);
?>

<style>
/* ===== GLOBAL HEADER OVERLAY ===== */
.site-header { margin-bottom: -100px; background: transparent !important; box-shadow: none; position: relative; z-index: 130; }
.site-header a, .site-header i { color: #fff !important; }

.bmw-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px; color: #fff; text-align: center; position: relative;
}
.bmw-hero h1 { font-size: 48px; font-weight: 800; margin: 0; }
.hero-shape { position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5; }
.hero-shape svg { width: 100%; height: 80px; }

.bmw-content { padding: 80px 0; background: #f8f9fa; min-height: 600px; }
.bmw-filter-box {
    background: #fff; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    margin-bottom: 40px; display: flex; gap: 20px; align-items: flex-end; flex-wrap: wrap;
}
.filter-group { display: flex; flex-direction: column; gap: 8px; }
.filter-group label { font-weight: 700; color: #333; font-size: 14px; }
.filter-group select { padding: 12px 20px; border: 1px solid #ddd; border-radius: 10px; min-width: 150px; }

.view-toggle { margin-left: auto; background: #f0f4f8; padding: 5px; border-radius: 12px; display: flex; gap: 5px; }
.view-btn {
    padding: 10px 20px; border-radius: 8px; text-decoration: none; color: #666; font-weight: 700; font-size: 14px; transition: all 0.3s ease;
    cursor: pointer; border: none; background: transparent;
}
.view-btn.active { background: #0065a5; color: #fff; }

.btn-filter {
    background: #ff9933; color: #fff; padding: 12px 30px; border-radius: 10px; border: none; font-weight: 700; cursor: pointer; transition: all 0.3s ease;
}
.btn-filter:hover { background: #e68a00; }
.btn-clear { color: #888; text-decoration: none; font-size: 14px; font-weight: 600; margin-left: 10px; cursor: pointer; }

#bmw-response-container { transition: opacity 0.3s ease; }
.loading { opacity: 0.5; pointer-events: none; }

/* Grid & Chart Styles */
.reports-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
.report-card { background: #fff; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid transparent; display: flex; flex-direction: column; }
.report-card:hover { transform: translateY(-5px); border-color: #0065a5; }
.report-card-icon { width: 50px; height: 50px; background: #eef7ff; color: #0065a5; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 15px; }
.btn-view-card { margin-top: auto; background: #f8f9fa; color: #0065a5; text-align: center; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 14px; }

.graph-container { background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
.report-display-card { background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
.report-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
.report-header h2 { margin: 0; color: #0065a5; font-size: 24px; }
.bmw-data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
.bmw-data-table th, .bmw-data-table td { padding: 15px; text-align: center; border: 1px solid #eee; }
.bmw-data-table thead th { background: #0065a5; color: #fff; font-weight: 700; text-transform: uppercase; font-size: 13px; }
.category-cell { text-align: left !important; font-weight: 700; color: #333; background: #fcfcfc; }
.total-row { background: #eef7ff; font-weight: 800; font-size: 18px; color: #0065a5; }
.btn-download-pdf { background: #ff9933; color: #fff; padding: 12px 25px; border-radius: 50px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; border: none; cursor: pointer; }

/* Colors from image */
.th-red { background: #ff0000 !important; }
.th-yellow { background: #ffff00 !important; color: #000 !important; }
.th-blue { background: #0000ff !important; }
.th-white { background: #ffffff !important; color: #000 !important; border: 1px solid #ddd !important; }
</style>

<main class="bmw-reports-page">
    <section class="bmw-hero">
        <div class="container">
            <h1>Bio-Medical Waste Reports</h1>
            <p>Transparency in Healthcare Waste Management</p>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="bmw-content">
        <div class="container">
            <form id="bmw-filter-form" class="bmw-filter-box">
                <input type="hidden" name="view" id="bmw-view-input" value="list">
                <div class="filter-group">
                    <label>Year</label>
                    <select name="year" id="bmw-year-select">
                        <option value="">All Years</option>
                        <?php foreach($years as $y): ?>
                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Month</label>
                    <select name="month" id="bmw-month-select">
                        <option value="">All Months</option>
                        <?php foreach($months as $m): ?>
                            <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-filter">Apply Filter</button>
                <a id="bmw-clear-btn" class="btn-clear" style="display:none;"><i class="fa-solid fa-xmark"></i> Clear</a>

                <div class="view-toggle">
                    <button type="button" class="view-btn active" data-view="list"><i class="fa-solid fa-table-list"></i> List View</button>
                    <button type="button" class="view-btn" data-view="graph"><i class="fa-solid fa-chart-line"></i> Graph View</button>
                </div>
            </form>

            <div id="bmw-response-container">
                <!-- Grid View of Reports on First Load -->
                <div class="reports-grid">
                    <?php if ($report_query->have_posts()): ?>
                        <?php while ($report_query->have_posts()): $report_query->the_post(); 
                            $r_month = get_post_meta(get_the_ID(), 'bmw_month', true);
                            $r_year  = get_post_meta(get_the_ID(), 'bmw_year', true);
                        ?>
                            <div class="report-card">
                                <div class="report-card-icon"><i class="fa-solid fa-file-invoice"></i></div>
                                <h3><?php echo esc_html($r_month . ' ' . $r_year); ?></h3>
                                <p>Waste Management Report</p>
                                <a href="javascript:void(0)" onclick="loadBMWReport('<?php echo $r_year; ?>', '<?php echo $r_month; ?>')" class="btn-view-card">View Report</a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="no-report"><h3>No reports available</h3></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
jQuery(document).ready(function($) {
    const ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    let myChart = null;

    function fetchBMWData() {
        const year = $('#bmw-year-select').val();
        const month = $('#bmw-month-select').val();
        const view = $('#bmw-view-input').val();
        
        $('#bmw-response-container').addClass('loading');
        
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_bmw_reports_ajax',
                year: year,
                month: month,
                view: view
            },
            success: function(response) {
                $('#bmw-response-container').removeClass('loading');
                if (response.success) {
                    $('#bmw-response-container').html(response.data.html);
                    
                    // Show/Hide Clear Button
                    if (year || month) {
                        $('#bmw-clear-btn').show();
                    } else {
                        $('#bmw-clear-btn').hide();
                    }

                    // If Graph View or Year Filtered, initialize Chart
                    if (view === 'graph' || (year && !month)) {
                        setTimeout(() => {
                            initBMWChart(response.data.graph_data);
                        }, 100);
                    }
                }
            }
        });
    }

    function initBMWChart(graphData) {
        const ctx = document.getElementById('bmwTrendChart');
        if (!ctx) return;

        if (myChart) myChart.destroy();

        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const datasets = [];
        const colors = ['#0065a5', '#ff9933', '#10b981', '#ef4444', '#8b5cf6'];
        let cIdx = 0;

        for (const year in graphData) {
            datasets.push({
                label: `Total Weight ${year} (kg)`,
                data: graphData[year],
                borderColor: colors[cIdx % colors.length],
                backgroundColor: colors[cIdx % colors.length] + '20',
                tension: 0.4,
                fill: true,
                pointRadius: 6
            });
            cIdx++;
        }

        myChart = new Chart(ctx, {
            type: 'line',
            data: { labels, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // Form Submit
    $('#bmw-filter-form').on('submit', function(e) {
        e.preventDefault();
        fetchBMWData();
    });

    // View Toggle
    $('.view-btn').on('click', function() {
        $('.view-btn').removeClass('active');
        $(this).addClass('active');
        $('#bmw-view-input').val($(this).data('view'));
        fetchBMWData();
    });

    // Clear Filter
    $('#bmw-clear-btn').on('click', function() {
        $('#bmw-year-select').val('');
        $('#bmw-month-select').val('');
        fetchBMWData();
    });

    // Global function for View Report link
    window.loadBMWReport = function(year, month) {
        $('#bmw-year-select').val(year);
        $('#bmw-month-select').val(month);
        $('#bmw-view-input').val('list');
        $('.view-btn[data-view="list"]').addClass('active').siblings().removeClass('active');
        fetchBMWData();
    };
});

function generateBMW_PDF_Detail() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'pt');
    const title = document.querySelector('.report-header h2').innerText;
    const table = document.querySelector('.bmw-data-table');
    doc.setFontSize(20);
    doc.setTextColor(0, 101, 165);
    doc.text("KMNU Hospitals - Bio-Medical Waste Report", 40, 40);
    doc.autoTable({ html: table, startY: 80, theme: 'grid', headStyles: { fillColor: [0, 101, 165] } });
    doc.save(`BMW_Report_${title.replace(' ', '_')}.pdf`);
}
</script>

<?php get_footer(); ?>
