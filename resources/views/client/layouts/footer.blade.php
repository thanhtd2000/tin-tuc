<footer id="footer">
    <p>&copy; Copyright 2023 - PHP3-Laravel All Rights Reserved</p>
</footer>

<script src="../../../client/function.js"></script>
<script src={{ url('ckeditor/ckeditor.js') }}></script>
<script>
    CKEDITOR.replace('content');
</script>
@include('ckfinder::setup')
</body>

</html>
