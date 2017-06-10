<div class="share">
  <ul>
  <li><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() . ' - ' . get_bloginfo('name') ); ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>"
  onclick="window.open(this.href, 'SNS', 'width=500, height=300, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-tw">
    <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x" style="color:#55acee"></i>
      <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
    </span>
  </a></li>
  <li><a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>"
  onclick="window.open(this.href, 'SNS', 'width=500, height=500, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-fb">
    <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x" style="color:#3b5998"></i>
      <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
    </span>
  </a></li>
  <li><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>"
  onclick="window.open(this.href, 'SNS', 'width=500, height=500, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-gp">
    <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x" style="color:#dd4b39"></i>
      <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
    </span>
  </a></li>
  </ul>
</div><!-- end share -->
