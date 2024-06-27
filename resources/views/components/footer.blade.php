@auth
<!-- Authenticated footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2024 - {{date('Y')}} D2 Laboratory</strong>
    All rights reserved.
</footer>
@else
<!-- Unauthenticated footer -->
<footer class="bg-white border-top bottom-0 text-center position-fixed w-100 p-2">
    <strong>Copyright &copy; 2024 - {{date('Y')}} D2 Laboratory</strong>
    All rights reserved.
</footer>
@endauth