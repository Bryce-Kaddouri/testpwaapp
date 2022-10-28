<div>

    <nav role="navigation">
        <div id="menuToggle">

            <!--
          A fake / hidden checkbox is used as click reciever,
          so you can use the :checked selector on it.
          -->
            <input type="checkbox" />
            <div class="stat">

                <h1 style="color: white;position:relative;bottom: 2.5rem;right: 1.5rem;">Statistique</h1>
            </div>
            <!--
          Some spans to act as a hamburger.
          
          They are acting like a real hamburger,
          not that McDonalds stuff.
          -->

            <span></span>
            <span></span>
            <span></span>

            <!--
          Too bad the menu has to be inside of the button
          but hey, it's pure CSS magic.
          -->

            <ul id="menu">
                <div class="wrapper">
                    <!-- <div class="lbox"> -->

                </div>

                <?php


                $nivActuel = $nivActuel['enigme_id'];
                echo "niveau actuel : " . $nivActuel;
                foreach ($enigme as $enigm) {

                    if ($enigm['id'] < $nivActuel) {
                        $color = 'green';
                    } else {
                        $color = 'red';
                    }
                ?>
                    <div class="enigme<?php echo $enigm['id'] ?>" style="background:<?php echo $color; ?>;border: 2px black groove; height:50px" class="glace">
                        <?php
                        echo $enigm['nom'];
                        echo $enigm['id'];
                        // echo $enigm['flag'];
                        echo $enigm['point']; ?>
                        <button dt-idEnigme="<?php echo $enigm['id']; ?>" class="btnTestFlag">Try It</button>
                    </div>
                <?php } ?>

        </div>



        </ul>
</div>
</nav>



</div>
<script>
    $(document).ready(function() {
        $(".btnTestFlag").click(function() {
            var idEnigme = $(this).attr("dt-idEnigme");
            swal.fire({
                title: 'Entrez le flag',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    $.ajax({
                        url: "ajax/ajax.php",
                        type: "POST",
                        data: {
                            action: "testFlag",
                            flag: login
                        },
                        success: function(data) {
                            if (data == 'true') {
                                swal.fire({
                                    title: 'Bravo ! ',
                                    text: 'Vous avez trouvé la bonne réponse',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "ajax/ajax.php",
                                            type: "POST",
                                            data: {
                                                action: "addPoint",
                                                idEnigme: idEnigme,
                                                idEquipe: <?php echo $_SESSION['id']; ?>
                                            },
                                            success: function(data) {
                                                console.log('data : ' + data.value);
                                                swal.fire({
                                                    text: 'Vous avez gagné ' + data + ' points',
                                                    html: '<img src="../images/trophyWin.GIF" alt="gif" width="80%" height="90%">',
                                                    confirmButtonText: 'OK',
                                                    background: '#6766A9',
                                                    timer: 5000
                                                })
                                                // reload #tabScore
                                                // $('.enigme' + idEnigme).css('background', 'green');
                                                // window.location.href = "index.php?uc=enigme&action=tabScore";

                                            }
                                        });
                                    }
                                })
                            } else {
                                swal.fire({
                                    title: 'Mauvaise réponse',
                                    text: 'Vous avez trouvé la mauvaise réponse',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            // })

            // var flag = prompt("Entrer le flag");
            // $.ajax({
            //     url: "ajax/ajax.php",
            //     type: "POST",
            //     data: {
            //         action: "testFlag",
            //         idEnigme: idEnigme,
            //         flag: flag
            //     },
            //     success: function(data) {
            //         console.log(data);
            //     }
            // });
        });
    });
</script>