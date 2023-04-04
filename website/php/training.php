<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Training</title>
</head>
<style>
    ul.training {
        margin: 10px;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 1rem;
    }
    li {
        display: grid;
        grid-template-columns: 0 1fr;
        gap: 1.75em;
        align-items: start;
        font-size: 1.5rem;
        line-height: 1.25;
    }
    ul li::before {
        content: attr(data-icon);
        font-size: 1.25em;
    }

</style>
<body>
    <?php include_once("navbar.php");?>
    <br><br>
    <ul class="training">
        <li data-icon="💡">What is stock trading? Wikipedia defines stock trading as such: A stock trader or equity trader or share trader, also called a stock investor, is a person or company involved in trading equity securities and attempting to profit from the purchase and sale of those securities.
             Stock traders may be an investor, agent, hedger, arbitrageur, speculator, or stockbroker. Such equity trading in large publicly traded companies may be through a stock exchange.</li><br>
        <li data-icon="💡">Another fact</li><br>
        <li data-icon="💡">Third fact</li><br>
        <li data-icon="💡"> Testing for length on next one for scrolling</li><br>
        <li data-icon="💡">Lorem ipsum dolor sit amet. Est repellat illo ut suscipit internos eos eveniet facilis nam nemo omnis est libero similique et d<br>olorem totam! Vel vitae nemo eum molestias internos ut corporis nulla aut tenetur animi eos sint corporis. In molestiae recusandae eum cumque cumque aut exercitationem voluptas.
        33 alias magnam ut eius illo ab natus aliquam. <br>Est laudantium corporis sit quis illo hic tempora atque eum unde rerum ut omnis dolores. Ad enim galisum sit alias voluptatem est ipsa quia est modi optio? Et rerum nihil ab aliquid possimus et atque laudantium.
        Ut eveniet soluta et nisi adipisci ut modi debitis et libero quam et impedit vero. Vel optio repudiandae ut volupt<br>as nesciunt sit recusandae commodi id dolorum assumenda.</li><br>
        <li data-icon="💡">Lorem ipsum dolor sit amet. Est repellat illo ut suscipit internos eos eveniet facilis nam nemo omnis est libero similique et d<br>olorem totam! Vel vitae nemo eum molestias internos ut corporis nulla aut tenetur animi eos sint corporis. In molestiae recusandae eum cumque cumque aut exercitationem voluptas.
        33 alias magnam ut eius illo ab natus aliquam. <br>Est laudantium corporis sit quis illo hic tempora atque eum unde rerum ut omnis dolores. Ad enim galisum sit alias voluptatem est ipsa quia est modi optio? Et rerum nihil ab aliquid possimus et atque laudantium.
        Ut eveniet soluta et nisi adipisci ut modi debitis et libero quam et impedit vero. Vel optio repudiandae ut volupt<br>as nesciunt sit recusandae commodi id dolorum assumenda.</li><br>
        <li data-icon="💡">Lorem ipsum dolor sit amet. Est repellat illo ut suscipit internos eos eveniet facilis nam nemo omnis est libero similique et d<br>olorem totam! Vel vitae nemo eum molestias internos ut corporis nulla aut tenetur animi eos sint corporis. In molestiae recusandae eum cumque cumque aut exercitationem voluptas.
        33 alias magnam ut eius illo ab natus aliquam. <br>Est laudantium corporis sit quis illo hic tempora atque eum unde rerum ut omnis dolores. Ad enim galisum sit alias voluptatem est ipsa quia est modi optio? Et rerum nihil ab aliquid possimus et atque laudantium.
        Ut eveniet soluta et nisi adipisci ut modi debitis et libero quam et impedit vero. Vel optio repudiandae ut volupt<br>as nesciunt sit recusandae commodi id dolorum assumenda.</li><br>
    </ul>
    </div>
</body>
</html>