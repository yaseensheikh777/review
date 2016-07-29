<script type="text/javascript" src="<?php echo HTTP_SERVER; ?>/assets/js/feedback.js"></script>
<div class="feedback-container" >
<div class="alert alert-danger" id="error-message-div">
    <a href="#" class="close" id="error-hide" data-dismiss="alert" aria-label="close" title="close">×</a><span id="error-message"></span>
</div>

<h2 class="register-h2">Feedback</h2>
<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" class="radio" /><label for="star5" title="Rocks!">5 stars</label>
    <input type="radio" id="star4" name="rating" value="4" class="radio" /><label for="star4" title="Pretty good">4 stars</label>
    <input type="radio" id="star3" name="rating" value="3" class="radio" /><label for="star3" title="Meh">3 stars</label>
    <input type="radio" id="star2" name="rating" value="2" class="radio" /><label for="star2" title="Kinda bad">2 stars</label>
    <input type="radio" id="star1" name="rating" value="1" class="radio" /><label for="star1" title="Sucks big time">1 star</label>
</fieldset>

<span><input type="text" placeholder="Title" id="title" class="input-register"></span>
<span><textarea class="text-feedback" placeholder="Comment" id="comment" maxlength="500" rows="8"></textarea></span>
<span><button class="register-button btn btn-default" id="feedback"> Save</button></span>
</div>