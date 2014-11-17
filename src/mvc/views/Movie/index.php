<?php
$title    = "Movies";
$styles   = ['movie.css'];
$scripts  = ['helper.js', 'movie.js', 'movies.js'];
ob_start();
?>
    <div class="container">
        <div align="right">
            <div align="center" id="logoutBtnHolder">
                <span class="exit">LOGOUT</span>
            </div>
        </div>
        <div align="center" class="top">
            <h2>ADD NEW MOVIE</h2>
        </div>
        <div align="center" >
            <table border="0">
                <tr>
                    <td align="left"><b>NAME</b></td>
                    <td align="left"><b>RELEASE YEAR</b></td>
                </tr>
                <tr>
                    <td align="right"><input name="name" type="text" id="name" value="" maxlength="20" tabindex="1"/></td>
                    <td align="right">
                        <select style="width:100%" id="releaseYear" name="releaseYear" tabindex="2">
                            <option value="" selected disabled>Year</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="buttondiv">
                        <button id="addBtn" name="addBtn" tabindex="5">ADD</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="buttondiv">
                        <button id="allBtn" name="allBtn" tabindex="6">ALL</button>
                        <button id="searchBtn" name="searchBtn" class="button" tabindex="7">SEARCH</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><span id="msgbox" style="display:none"></span></td>
                </tr>
            </table>
        </div>
        <div align="center" id="moviesTableHolder"></div>
        <div class="route" id="controllerRoute"><?php echo ROOT.'web/movies/'; ?></div>
        <div class="route" id="logoutRoute"><?php echo ROOT.'web/logout'; ?></div>
    </div>
<?php
$content = ob_get_clean();
include LAYOUT;