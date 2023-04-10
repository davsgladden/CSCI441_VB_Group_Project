<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    }


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
        <li data-icon="💡">The stock market is made of exchanges listed on specific exchanges that bring buyers and sellers
            together to act as a market for shares of said stocks. The business tracks the supply and demand of each
            stock. A market index tracks the performance of stocks that represent the market as a whole and uses
            indexes to benchmark the performance of their portfolio and inform stock trading decisions.</li><br>
        <li data-icon="💡">Individual traders are represented by brokers that place stock trades that deal with the
            exchange of goods. Their role is to ensure that investment opportunities are capitalized to yield the
            greatest return. Inflation, stock market volatility, supply-chain issues, and interest rates can unsettle
            investors. In contrast, investors are advised to build a diversified portfolio to create a resilient one.</li><br>
        <li data-icon="💡">The importance of a diversified, well-rounded portfolio is due to the inevitable, unenviable
            setback from a bear market. To avoid company-specific risk, multiple investment strategies are pooled
            to mitigate losses while accepting risk. Building a diversified portfolio takes time, patience, and research.</li><br>
        <li data-icon="💡">While buying and holding stocks over the long term builds the best return, knowing when to sell
            stocks is essential. Situation awareness is vital when dictating where resources are to go as an optimal
            investment opportunity. While options are available to determine whether to be an active or</li><br>
        <li data-icon="💡">As a result, a few planning aids need to be in effect to support the planning process. Every
            presentation, listing brochure, sale, or lease can help with online and electronic planning tools and aids.</li><br>
        <li data-icon="💡">Those that struggle fail to plan and systemize their activities for each working day; in contrast,
            with new businesses fail to recognize the priorities in place to apply those critical elements to keep
            businesses up to date with changes in the dynamic market.</li><br>
        <li data-icon="💡">Strategies and tactics may need to be adjusted but the market conditions require repetition and
            a fine tuned approach in a systematic approach to work. As such, to create a broker that can diversify
            and streamline the process of breaking down goods and services require to identify critical outliers and
            recognize outcomes to maintain a standard to be successful.</li><br>
    </ul>
    </div>
</body>
</html>