<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poni's CMS</title>

        <style>
            body{
                width: 100%;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;
                font-size: 3rem;
                color: white;
                font-family: Arial, Helvetica, sans-serif;

            }

            p{
                background: blue;
                width: max-content;
                text-align: center;
                padding: 1rem;
            }

            a{
                background: white;
                color: blue !important
            }

            p:hover{
                filter: hue-rotate(90deg) 
            }

            a:hover{
                filter: invert()
            }

            body {
      cursor: none; /* Nascondi il cursore nativo */
    }
    #custom-cursor {
      position: fixed;
      left: 0;
      top: 0;
      width: 40px;
      height: 40px;
      pointer-events: none; /* L'elemento non interferisce con gli eventi */
      background: url('catto.png') no-repeat center center;
      background-size: contain;
      transform-origin: center;
      transition: transform .05s ease-in-out;
      z-index: 100;
    }
        </style>


    </head>
    <body>
        <div id="custom-cursor"></div>
        <p> Ciao!

            :)</p>

            <p>Molto probabilmente non dovresti stare qua :O</p>

            <p>Ma magari dovresti se vuoi un sito costruito da me!  <br>
                <a href="https://computomanzia.link">https://computomanzia.link</a></p>
       
     

                <script>
                    const cursor = document.getElementById('custom-cursor');
                
                    document.addEventListener('mousemove', e => {
                      // Aggiorna la posizione del cursore personalizzato
                      cursor.style.left = e.clientX + 'px';
                      cursor.style.top = e.clientY + 'px';
                    });
                
                    // Esempio di animazione: ruotare e ingrandire il cursore
                    let angle = 0;
                    function animateCursor() {
                      angle = (angle + 1) % 360;
                      // Qui, scale(1.5) ingrandisce l'immagine; modifica i valori a piacimento
                      cursor.style.transform = `translate(-50%, -50%) rotate(${angle}deg) scale(2.5)`;
                      requestAnimationFrame(animateCursor);
                    }
                    animateCursor();
                  </script>
    </body>

    
</html>
