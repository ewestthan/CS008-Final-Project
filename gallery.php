<?php include 'top.php';?>
<main>
        <h2>Sample Works</h2>
        <p>Below are four sample works from our current collection, comprising a wide range of artists, from the abstract works of Piet Mondrian to the realistic works of Claude Monet. Artem Galleries prides itself on this range, as it allows for all who visit to find a piece they enjoy observing.</p>
        <table>
                <caption>Our Available Art Pieces</caption>
                <tr>
                        <th>Piece</th>
                        <th>Creator</th>
                        <th>Cost (in millions)</th>
                </tr>
        
                <?php
                $sql = 'SELECT fldPiece, fldCreator, fldCost FROM tblPieces';

                $statement = $pdo->prepare($sql);
                $statement->execute();

                $records = $statement->fetchAll();

                foreach($records as $record){
                        print '<tr>';
                        print '<td>' . $record['fldPiece'] . '</td>';
                        print '<td>' . $record['fldCreator'] . '</td>';
                        print '<td>' . $record['fldCost'] . '</td>';
                        print '</tr>' . PHP_EOL;
                }   
                ?>
        </table>
        <section class="img-container">
                <figure>
                        <img class="haring" alt="haring" src="images/haring.jpeg">
                        <figcaption><cite><a href = "https://img.kingandmcgaw.com/imagecache/4/3/bmwcm-5.0_fid-880229_fwcm-1.6_ihcm-50.0_iwcm-50.0_lmwcm-5.0_maxdim-1000_mc-ffffff_rmwcm-5.0_si-435786.jpg_tmwcm-5.0.jpg" target = "_blank" >Untitled by Keith Haring</a></cite></figcaption>
                </figure>
       
                <figure>
                        <img class="monet" alt="monet" src="images/monet.jpeg">
                        <figcaption><cite><a href = "https://images.saatchiart.com/saatchi/845756/art/2975166/additional_1f5cbd59172ccfef315ecff34f15c653df226999-8.jpg" target = "_blank" >Water Lilies by Monet</a></cite></figcaption>
                </figure>

                <figure>
                        <img class="mondrian" alt="mondrian" src="images/mondrian.jpeg">
                        <figcaption><cite><a href = "https://www.moma.org/media/W1siZiIsIjQ3NzIxMiJdLFsicCIsImNvbnZlcnQiLCItcXVhbGl0eSA5MCAtcmVzaXplIDIwMDB4MTQ0MFx1MDAzZSJdXQ.jpg?sha=efbb7a7cf0f43369" target = "_blank" >Broadway Boogie Woogie by Piet Mondrian</a></cite></figcaption>
                </figure>

                <figure>
                        <img class="hopper" alt="hopper" src="images/hopper.jpeg">
                        <figcaption><cite><a href = "https://images-na.ssl-images-amazon.com/images/I/71jRxhVlvjL._AC_SL1415_.jpg" target = "_blank" >Nighthawks by Edward Hopper</a></cite></figcaption>
                </figure>
        </section>
        <h2>Want to Buy?</h2>
        <p>If you are interested in purchasing a replica or the original work of any piece shown here, please head on over to our sales form and fill it out thoroughly. The information you provide there will help us in figuring out your request, and allow us to come to a deal you are happy with!</p>
</main>
<?php include 'footer.php'; ?>
</body>
</html>