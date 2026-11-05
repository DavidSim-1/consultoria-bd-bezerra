<?php
require_once 'config/database.php';
$titulo = 'Início | BD Bezerra';
$consulta = $pdo->query("SELECT * FROM servicos WHERE ativo = 1 ORDER BY id DESC");
$servicos = $consulta->fetchAll();
require 'includes/header.php';
?>
<section class="hero">
    <div>
        <p>TECNOLOGIA • PLANEJAMENTO • RESULTADOS</p>
        <h1>Soluções digitais para o crescimento da sua empresa.</h1>
        <p>A BD Bezerra oferece consultoria em Tecnologia da Informação para ajudar empresas a trabalhar com mais segurança, organização e eficiência.</p>
        <a class="botao" href="cadastro.php">Conheça nossa área do cliente</a>
    </div>
    <div class="hero-selo">
        <div style="font-size:54px;font-weight:bold">BD</div>
        <h2>Consultoria em TI</h2>
        <p>Conectando pessoas, processos e tecnologia.</p>
    </div>
</section>

<section class="secao">
    <h2>Nossos serviços</h2>
    <div class="grade">
        <?php foreach ($servicos as $servico): ?>
            <article class="cartao">
                <h3><?= htmlspecialchars($servico['nome']) ?></h3>
                <p><?= nl2br(htmlspecialchars($servico['descricao'])) ?></p>
                <p class="pequeno">Valor inicial: <?= $servico['preco_base'] !== null ? 'R$ ' . number_format($servico['preco_base'], 2, ',', '.') : 'Sob consulta' ?></p>
            </article>
        <?php endforeach; ?>
        <?php if (!$servicos): ?><p>Nossos serviços serão cadastrados em breve.</p><?php endif; ?>
    </div>
</section>

<section class="secao">
    <h2>Conheça os sócios</h2>
    <div class="socios">
        <article class="cartao">
            <h3>Bezerra — Sócio e Consultor</h3>
            <p>Atua no planejamento de soluções tecnológicas, atendimento ao cliente e análise de necessidades empresariais.</p>
            <p class="pequeno">Currículo resumido fictício — personalize com os dados reais da dupla.</p>
        </article>
        <article class="cartao">
            <h3>Segundo sócio — Desenvolvimento</h3>
            <p>Atua no desenvolvimento de aplicações, organização de bancos de dados e suporte aos projetos de tecnologia.</p>
            <p class="pequeno">Substitua pelo nome e currículo do segundo integrante.</p>
        </article>
    </div>
</section>
<?php require 'includes/footer.php'; ?>
