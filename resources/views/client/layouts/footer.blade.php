<footer id="footer">
    <p>&copy; Copyright 2023 - PHP3-Laravel All Rights Reserved</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
</script>
<script src="../../../client/function.js"></script>
<script src={{ url('ckeditor/ckeditor.js') }}></script>
<script>
    CKEDITOR.replace('content');
</script>
@include('ckfinder::setup')
<script>
    let get;
    fetch('http://127.0.0.1:8000/api/category')
        .then(res => res.json())
        .then(data => {
            const category = document.getElementById('category')
            const html = data.data.map(item => {
                return `<a href="/category/${item.id}"><img src="../../../${item.image}" alt="">${item.category_name}</a>`
            })
            category.innerHTML = html.join('')
        })
</script>
</body>

</html>
