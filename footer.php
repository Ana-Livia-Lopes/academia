<footer>
            <div id="footer">
            <div class="contato">
                <h2>Informações de Contato <strong>Power Gym</strong></h2>
            </div>
                <div class="contato">
                    <p id="pfooter">Endereço: Rua das Palmeiras, 1234, Bairro Vista Alegre, Cidade Nova, Estado Sol Nascente</p> <p id="pfooter">Telefone: (12) 3653-1756</p> <p id="pfooter">E-mail: powe.gym@gmail.com.br</p>
            
                </div> 
            
        </footer> 
        <style>
            
            
footer {
    height: 100%;
    background-color: rgb(255, 255, 255);
    width: 100%;
    color: black;
    margin-top: 100px;
}

.contato {
    justify-content: space-evenly;
    display: flex;
    margin-top: 30px;
    padding-top: 20px;
}

#pfooter {
    margin-bottom: 40px;
}

footer h2 {
    margin-bottom: 10px;
    font-family: 'Montserrat', sans-serif;
}

footer p {
    font-size: 14px;
    line-height: 1.5;
    font-family: "Plus Jakarta Sans", sans-serif;
    margin-bottom: 10px;
}


@media (max-width: 768px){
    #footer {
        display: block;
        overflow-wrap: break-word;
        padding: 25px;
    }
    #footer h2{
        font-size: 24px;
    }
    #footer p{
        font-size: 13px;
    }

}
        </style>