@php
    session_start();

session_destroy();
echo "CERRANDO SISTEMA<br>
<script>
    location.href='logindocente';
</script>
";
@endphp