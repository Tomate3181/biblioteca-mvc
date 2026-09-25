<!-- Footer -->
<footer class="footer">
    <p><i class="fa-solid fa-feather-pointed" style="color: var(--amber); margin-right: 6px;"></i> <span
            class="footer__brand">Biblioteca Arcana</span> — Sistema de Gerenciamento de Acervo</p>
    <p style="margin-top:6px;">Desenvolvido com PHP &amp; MVC — <?= date('Y') ?></p>
</footer>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal-overlay" id="modalExcluir">
    <div class="modal">
        <div class="modal__icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <h3 class="modal__title">Confirmar Exclusão</h3>
        <p class="modal__text">
            Tem certeza que deseja excluir o livro
            <strong id="modalNomeLivro"></strong>?<br>
            Esta ação não poderá ser desfeita.
        </p>
        <div class="modal__actions">
            <button class="btn btn--secondary" onclick="fecharModal()"><i class="fa-solid fa-xmark"></i>
                Cancelar</button>
            <a class="btn btn--danger" id="modalLinkExcluir" href="#"><i class="fa-solid fa-trash-can"></i> Excluir</a>
        </div>
    </div>
</div>

<script>
    /* ── Modal de exclusão ──────────────────────────────── */
    function confirmarExclusao(id, titulo) {
        document.getElementById('modalNomeLivro').textContent = titulo;
        document.getElementById('modalLinkExcluir').href = 'index.php?acao=excluir&id=' + id;
        document.getElementById('modalExcluir').classList.add('active');
    }

    function fecharModal() {
        document.getElementById('modalExcluir').classList.remove('active');
    }

    // Fechar modal ao clicar fora
    document.getElementById('modalExcluir').addEventListener('click', function (e) {
        if (e.target === this) fecharModal();
    });

    // Fechar modal com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') fecharModal();
    });

    /* ── Auto-fechar alertas ────────────────────────────── */
    document.querySelectorAll('.alert__close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            this.closest('.alert').style.display = 'none';
        });
    });

    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (el) {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';
            setTimeout(function () { el.style.display = 'none'; }, 500);
        });
    }, 5000);
</script>

</body>

</html>