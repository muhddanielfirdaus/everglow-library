<style>
footer {
    padding: 12px;
    text-align: center;
    font-weight: bold;
}

.footer-guest {
    background-color: #FFE4B5;
}

.footer-auth {
    background-color: #DEB887;
}
</style>

<footer class="{{ Auth::check() ? 'footer-auth' : 'footer-guest' }}">
    © Copyright Reserved by EVERGLOW ACADEMY
</footer>
