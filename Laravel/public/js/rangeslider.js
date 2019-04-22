      $('input[type="range"]').rangeslider({
          polyfill: false,
          // Default CSS classes
          rangeClass: 'rangeslider',
          disabledClass: 'rangeslider--disabled',
          horizontalClass: 'rangeslider--horizontal',
          fillClass: 'rangeslider__fill',
          handleClass: 'rangeslider__handle',
          // Callback function
          onInit: function() {
              $rangeEl = this.$range;
              // add value label to handle
              var val;
              switch (this.value) {
                  case 0:
                      val = 'Всички';
                      break;
                  case 50:
                      val = 'Пораснали';
                      break;
                  default:
                      val = this.value;
                      break;
              }
              var $handle = $rangeEl.find('.rangeslider__handle');
              var handleValue = '<div class="rangeslider__handle__value">' + val + '</div>';
              $handle.append(handleValue);
              // get range index labels
              var rangeLabels = this.$element.attr('labels');
              rangeLabels = rangeLabels.split(', ');
              // add labels
              $rangeEl.append('<div class="rangeslider__labels"></div>');
              $(rangeLabels).each(function(index, value) {
                  $rangeEl.find('.rangeslider__labels').append('<span class="rangeslider__labels__label">' + value + '</span>');
              })
          },
          // Callback function
          onSlide: function(position, value) {
              var val = this.value;
              var $handle = this.$range.find('.rangeslider__handle__value');
              switch (this.value) {
                  case 0:
                      val = 'Всички';
                      break;
                  case 50:
                      val = 'Пораснали';
                      break;
                  default:
                      val = this.value;
                      break;
              }
              $handle.text(val);
          },
          // Callback function
          onSlideEnd: function(position, value) {
            //bobby call controller with age and free/paid check box
            if(free){
              window.location.href = basePath+'?age='+value+'&free=1';   
            }
            else{
              window.location.href=basePath+'?age='+value;
            }
          }
      });