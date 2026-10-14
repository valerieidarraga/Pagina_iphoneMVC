<section class="contacto">
    <h2>Contáctanos</h2>
    <p>
        Queremos conocer tu opinión sobre el mundo del iPhone.
        Déjanos tus datos y comparte tus comentarios.
    </p>
    <?php if (!empty($mensaje_db)): ?>
        <div class="mensaje-contacto">
            <?= htmlspecialchars($mensaje_db, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>
    <form
        action="contacto"
        method="POST"
        class="formulario"
    >
        <label for="nombre">Nombre completo:</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Escribe tu nombre"
            required
        >
        <label for="email">Correo electrónico:</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Escribe tu correo electrónico"
            required
        >
        <label for="comentario">Tu comentario:</label>
        <textarea
            id="comentario"
            name="comentario"
            rows="5"
            placeholder="Escribe tu opinión sobre el iPhone"
            required
        ></textarea>
        <button type="submit">Enviar comentario</button>
    </form>
</section>