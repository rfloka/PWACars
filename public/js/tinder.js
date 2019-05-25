(function() {
    let card = document.getElementById("swiper-card");
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    var indexPhp = [];
    //Simulated JSON data
    let currentCardIndex = 0;
    let startingMouseX = 0;
    let mouseWasDown = false;
    const cardInfo = JSON.parse(div.textContent);
    //Update swipe-card values from json
    function populateNextCard(){
      if (currentCardIndex === cardInfo.length){
        currentCardIndex = 0;
        document.getElementById("colec").style.display = "none";
        document.getElementById("fim").style.display = "block";
        console.log(indexPhp);
       
      }
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'enviar',
        data: {id : indexPhp},
        async: false
      });
      let currentCardData = cardInfo[currentCardIndex];
      let cardImage = document.getElementsByClassName("swiper-card-img")[0]
      let cardName = document.getElementsByClassName("swiper-card-name")[0]
      let cardLocation = document.getElementsByClassName("swiper-card-location")[0] 
      cardImage['src'] = '/storage/upload/viaturaspics/'+ currentCardData.nome;
      cardName.innerHTML = currentCardData.titulo;
      cardLocation.innerHTML = currentCardData.preco+'€';
      indexPhp.push( currentCardData.id);  
    }
  
    //Trigger css animations and populate card values
    function leftSwipe(){
      indexPhp.pop();
      currentCardIndex++;
      card.style.animationName = "leftSwipe";
      setTimeout(function(e){
        card.style.animationName = "fadeDownIn";
        populateNextCard();
      },500);
    }
    function rightSwipe(){
      currentCardIndex++;
      card.style.animationName = "rightSwipe"
      setTimeout(function(e){
        card.style.animationName = "fadeDownIn";
        populateNextCard();
      },500);     
    }
    
    // ----Swiping inputs below-----
   
  //---Keyboard Input
    //Arrow keys
    document.onkeydown = function(e){
      const left = 37;
      const right = 39;
  
      if(e.keyCode === left){
        leftSwipe();
      }
      if(e.keyCode === right){
        rightSwipe();
      }
    };
  
  // ---Mouse Swiping Input
    //Start mouse swipe inside card.
    card.addEventListener("mousedown",function(e){
      startingMouseX = e.clientX;
      mouseWasDown = true;
    });
    
    //End Mouse swipe with Mouse move event
    card.addEventListener("mousemove",function(e){
      if(mouseWasDown){
          let newMouseX = e.clientX;
          if(newMouseX < startingMouseX){
            leftSwipe();
          }
          else if(newMouseX > startingMouseX){
            rightSwipe();
          }
          mouseWasDown = false;
      }
    });
    
  //---Mobile Devices Input
    //Touch start inside swipe-card.
    card.addEventListener("touchstart",function(e){
      startingMouseX = e.touches[0].clientX;
      mouseWasDown = true;
    });
    
    //Touch move left or right
    card.addEventListener("touchmove",function(e){
      if(mouseWasDown){
          let newMouseX = e.touches[0].clientX;
          if(newMouseX < startingMouseX){
            leftSwipe();
          }
          else if(newMouseX > startingMouseX){
            rightSwipe();
          }
          mouseWasDown = false;
      }
    });
    
    //Populate the first card when page loads.
    populateNextCard();
  })();
  