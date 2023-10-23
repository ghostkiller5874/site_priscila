<section>
    <div class="center">
        <div class="box-acs">
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <div class="box-acs-single w33">
                    <div class=" imagem">
                        <img src="<?php echo INCLUDE_PATH ?>images/pulseira.jpg" alt="">
                        <h4>Pulseiras</h4>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="clear"></div>
</section>
<section>
    <div class="center">
        <?php
        for ($y = 0; $y < 3; $y++) {
        ?>
            <div class="container">
               
                <div class="box-joia w30 left">
                    <a href="<?php echo INCLUDE_PATH;?>produto"><img src="<?php echo INCLUDE_PATH ?>images/pulseira.jpg" alt=""></a>
                    
                </div>
                <div class="box-descricao w70 left">
                    <a href="<?php echo INCLUDE_PATH;?>produto"><h2>Conjunto Semi-joia Pulseira</h2></a>
                    
                    <ul>
                        <li>Cód: 5132432164165</li>
                        <li>Categoria: Pulseira</li>
                    </ul>
                    <p>Por <b>R$ 210,00</b></p>
                    <label for="">Cor:</label>
                    <select name="Cor" id="">
                    
                        <option value="">Preto</option>
                        <option value="">Branco</option>
                        <option value="">Roxo</option>
                    </select>
                    <button>Comprar</button>
                    
                </div>
                
                
            </div>
            <?php } ?>
        <div class="clear"></div>
    </div>
    
</section>