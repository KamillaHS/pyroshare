
    <link href="../../css/uploadPost.css" rel="stylesheet">
    <script src="../../js/uploadPost.js"></script>


<div id="opacity-background">
    <!-- Popup Div Starts Here -->
    <div id="uploadPost">
        <!-- Contact Us Form -->
        <form action="#" id="uploadForm" method="post" name="form">
<!--            <img id="close" src="images/3.png" onclick ="div_hide()">-->
            <i id="close" class="material-icons" onclick="div_hide()">clear</i>
            <h2 id="popupTitle">Upload new image</h2>
<!--            <hr>-->
            <input id="imgUpload" name="img" placeholder="Image url" type="text">
            <input id="imgTitle" name="title" placeholder="Title" type="text">
            <textarea id="imgDescription" name="description" placeholder="Description"></textarea>
            <a href="javascript:%20check_empty()" id="uploadPost-button" class="waves-effect waves-light btn" name="uploadPost">Upload</a>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->
<!--<h1>Click Button To Popup Form Using Javascript</h1>-->
<!--<button id="popup" onclick="div_show()">Popup</button>-->
