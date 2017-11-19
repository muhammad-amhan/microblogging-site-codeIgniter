
<!-- Page title -->
<h2 class="main-header"><?= $title; ?></h2>

<!-- Search form -->
<!-- Note that I did the form in two ways, one is the codeigniter opening tags in login form and post message for example, and one using html in the search fomr (here)
     just to demonstrate the use of both ways -->
<form class="search-form" action="search/dosearch" method="GET">
    <div class="search-wrapper">
        <input type="text" class="input-field" name="keyword" placeholder="Search site...">
        <button type="submit" class="btn">Search</button>
    </div>
</form>
