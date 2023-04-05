<footer class="footer">
    <div class="ms-auto">Powered by&nbsp;<a href="">Thành</a></div>
</footer>
</div>
<!-- CoreUI and necessary plugins-->
<script src="../../../dist
/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="../../../dist
/vendors/simplebar/js/simplebar.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="../../../dist
/vendors/chart.js/js/chart.min.js"></script>
<script src="../../../dist
/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="../../../dist
/vendors/@coreui/utils/js/coreui-utils.js"></script>
<script src="../../../dist
/js/main.js"></script>
<script src={{ url('ckeditor/ckeditor.js') }}></script>
<script>
    CKEDITOR.replace('editor');
</script>
@include('ckfinder::setup')
<script>
    const ctx1 = document.getElementById('myChart1').getContext('2d');
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    var data = @json($data);
    var data2 = @json($data2);
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Số bài viết',
                data: data.data,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: data2.labels,
            datasets: [{
                label: 'Số lượt like',
                data: data2.data,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>

</html>
