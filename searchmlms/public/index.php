<?php require_once('../private/initialize.php');

include(SHARED_PATH . '/public_header.php');
// GET
// user enters search, then hits enter to submit
// POST with form data like: mlm_search: 'whatever'
// PHP parses form data into $_POST dictionary
// pull mlm_search into php variable of the same name
?>
    <main id="main">
        <header class="search-bar">
            <div class="hero-fg">
                <form action="index.php" method="POST" id="search-form">
                    <h1 id="main-h1">Is&nbsp;<input aria-label="organization name" type="search" name="mlm_search"
                                                    id="mlm-search" required>&nbsp;an&nbsp;MLM?</h1>
                </form>

                <div class="search-results">
                    <?php
                    if (is_post_request()) {
                        $mlm_search = $_POST['mlm_search'] ?? '';
                        // check the database for mlm
                        $mlm = Mlm::find_by_mlm_name($mlm_search);
                        if ($mlm) {
                            if ($mlm->is_mlm == '1') { ?>
                                <p>Yes, <?= $mlm->mlm_name ?> is an MLM.</p>
                                <a href="<?= (url_for('/public/forum.php?mlm_id=' . $mlm->mlm_id)) ?>"
                                   class="home-mlm-link"><?= $mlm->mlm_name ?> Forum</a>
                            <a href="https://www.google.com/search?q=<?= $mlm->mlm_name; ?>"
                               target="_blank" class="home-mlm-link">Search in Google</a><?php
                            } else { ?>
                                <p>Nope, <?= $mlm->mlm_name ?> isn't an MLM.</p><?php
                            }
                        } else {
                            echo "Sorry, we're not sure what '" . h($mlm_search) . "' is.";
                        }
                    } ?>
                </div>

            </div>
            <div class="hero-bg">
                <img src="../images/magnifying-glass-128.png" width="128" height="128" alt="">
                <img src="../images/magnifying-glass-64.png" width="64" height="64" alt="">
                <img src="../images/magnifying-glass-640.png" width="256" height="256" alt="">
                <img src="../images/magnifying-glass-128.png" width="128" height="128" alt="">
                <img src="../images/magnifying-glass-640.png" width="216" height="216" alt="">
            </div>
        </header>

        <div id="main-content">
            <div>
                <h2>What is multi-level marketing?</h2>
                <p>Multi-level marketing (<abbr title="Multi-level Marketing">MLM</abbr> or MLMs) used to take place at
                    home parties or in coffee shops. In recent
                    years, it's become more
                    common on social media. Direct selling companies use multi-level marketing as a strategy to
                    encourage members to recruit more members into the company. These new members are known as the
                    recruiter's "downline".
                    Those who join MLMs are often called "distributors", "consultants", or "brand partners".
                    Often times, though, people who work for MLM companies are made to buy products
                    for personal use or run pricey auto shipments, effectively making them customers.
                </p>
                <p>
                    It can sometimes be difficult to tell from a company's website if they are an MLM company or not.
                    Use the search feature above to quickly find out if a company operates as an MLM.
                    Join in conversations about MLMs, or check out videos about multi-level marketing on YouTube.
                </p>
            </div>
            <img src="../images/boss.png" width="400" height="400" id="boss" alt="image representing boss babe vibes">
        </div>
    </main>
<?php include(SHARED_PATH . '/public_footer.php'); ?>