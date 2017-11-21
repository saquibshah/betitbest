/*global $*/

(function() {
  "use strict";

  $(document).ready(function() {
      var canvas, widthPercent, heightPercent, path, context, dir, i, pathItem;

      canvas = $('#formCheckCanvas');

      if (canvas.length === 0) {
          return;
      }

      canvas.attr('width', canvas.width());
      canvas.attr('height', canvas.height());

      widthPercent = canvas.width() / 100;
      heightPercent = canvas.height() / 100;
      path = canvas.attr('data-path').split(";");

      context = canvas[0].getContext("2d");
      context.beginPath();
      context.strokeStyle = '#cccccc';

      dir = {
        "loss": 83,
        "draw": 50,
        "win":  17
      };

      for (i = 0; i < path.length; ++i) {
          pathItem = path[i].split(":");

        if(i===0) {
          context.moveTo( widthPercent * 5.5 , heightPercent * dir[pathItem[1]] );
        } else {
          context.lineTo( widthPercent * (5.5 + 10*i ) , heightPercent * dir[pathItem[1]] );
        }

      }
      context.stroke();

      $('.formcheck-table span').each(function() {
          var tTipContent = "<center>" + $(this).attr('data-match') + "<br/>" + "(" + $(this).attr('data-result') + ")"
              + "</center>";
        $(this).tooltipster({
          content: tTipContent,
          contentAsHTML: true,
          theme: 'tooltipster-noir',
          touchDevices: false
        });
      });
  });
}());
