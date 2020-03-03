<?php
include "header.php";
?>
        <div class="p100">
            <div class="p90 content">
                <?php 
                    if(isset($_GET['erro'])) 
                        echo '<div class="warning"><p>Erro ao processar o seu pedido. Verifique as informações do plano.</p></div>';
                    if(isset($_GET['null'])) 
                        echo '<div class="warning"><p>Nenhum beneficiário inserido.</p></div>';
                ?>
                <form method="POST" action="simulacao.php">
                    <h2>Plano</h2>
                    <input type="text" id="registro" name="registro" placeholder="Registro" required>
                    <input type="text" id="plano" name="plano" placeholder="Plano" readonly>
                    <input hidden id="codigo" name="codigo" placeholder="Código" readonly>
                    <div class="divisor"></div>
                    <h2>Beneficiários</h2>
                    <div id="beneficiarios">
                        <div class="beneficiario">
                            <label>Nome:</label> <input type="text" name="beneficiario[nome][]" required>
                            <label>Idade:</label> <input type="number" name="beneficiario[idade][]" required><br>
                            <input type='button' class="delete" value="Remover">
                        </div>
                    </div>
                    <input type='button' class="add" value="Adicionar beneficiário">
                    <div class="divisor"></div>
                    <button type='submit' class="finalizar" name="finalizar">Finalizar</button>
                </form>
            </div>
        </div>

<?php
include "footer.php";
?>