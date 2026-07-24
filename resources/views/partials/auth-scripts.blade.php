<script>
document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var input = document.getElementById(btn.dataset.togglePassword);
        var show = btn.querySelector('.icon-show');
        var hide = btn.querySelector('.icon-hide');
        if (input.type === 'password') {
            input.type = 'text';
            show.style.display = 'none';
            hide.style.display = 'block';
        } else {
            input.type = 'password';
            show.style.display = 'block';
            hide.style.display = 'none';
        }
    });
});
</script>
