const swgl = {

    // General options
    options: {
        // Nav dots in lightbox
        'navDots' : true,

        // Options to load thumbnails for gallery(none are required, can be overwritten)
        // thumbs: {
        //     prefix: 't-',
        //     suffix: '',
        //     ext: 'jpg'
        // },
    
    }, // End options

    // Class reference
    // NOTE: This is passed in className, so multiple classes can be written with spaces between
    classes: {
        slideshowWrapper: 'swgl-slideshow',
        galleryWrapper: 'swgl-gallery',

        lightboxOverlay: "swgl-overlay",
        closeLighboxBtn: 'swgl-x-btn',
        xBtnBar: 'swgl-btn-bar',
        navArrow: 'swgl-nav-arrow',

        lightboxSlideshow: 'swgl-lightbox-slideshow',
        landscapeImg: 'landscape-img',
        portraitImg: 'portrait-img',
        slideshowImgBlock: 'swgl-imgs-wrap',
        slideshowSlide: 'swgl-slide',
        slideshowEffect: 'swgl-fade',
        slideshowDot: 'swgl-dot',
        nextArrow: 'swgl-next',
        prevArrow: 'swgl-prev'
    },

    /* =================
        Data
    ==================== */
    initializedSlideshows: [],
    
    /* =================
        Functions
    ==================== */
    initGallery: (elementOrId, options, classes)=>{
        swgl.createGallery(elementOrId, true, options, classes);        
    },

    initSlideshow: (elementOrId, options, classes)=>{
        swgl.createGallery(elementOrId, false, options, classes);
    },

    autoInit: ()=>{
        //Check for slideshows
        // Slideshows are essentially inline lightboxes
        const slideshows = [...document.getElementsByClassName(swgl.classes.slideshowWrapper)];
        //Check for galleries
        const galleries = [...document.getElementsByClassName(swgl.classes.galleryWrapper)];

        if(slideshows.length){
            for(let s = 0; s< slideshows.length; s++){
                swgl.createGallery(slideshows[s]);
            }
        }
        
        if(galleries.length){
            for(let g = 0; g< galleries.length; g++){
                swgl.createGallery(galleries[g], true);
            }
        }
    },

    createGallery: (maybeGallery, isLightbox, newOptions, newClasses)=>{
        const options = newOptions || swgl.options;
        let classes = swgl.classes;
        // Overwrites default classes but preserves defaults not in new classes
        if(newClasses && (typeof newClasses === 'object')) { 
            const copiedClasses = {};
            for(let classKey in swgl.classes){
                copiedClasses[classKey] = (newClasses[classKey] || swgl.classes[classKey]);
            }
            classes = copiedClasses;
        }
    
        var galleryElem = maybeGallery;

        //If an id was passed in, try to use it for retrieving element
        if(typeof galleryElem === "string"){ galleryElem = document.getElementById(galleryElem); }
        if(!galleryElem){
            console.log("No gallery element passed in, and couldn't find gallery by an id.");
            // If there is no gallery abort this function
            return false;
        }
    
        //Capture info of new slideshow for lightbox
        let newSliderInfo = {
            // Holds element reference
            el : null,
            // Starts at slide one
            current: 1,
            allImgs: [],
            navDots: []
        }
    
        let newSlideshow = galleryElem;
        // If this slideshow will be in a lightbox
        if(isLightbox){
            // Ensure gallery wrapper has class
            galleryElem.className += (' ' + classes.galleryWrapper);
            
            //New lightbox slideshow div
            newSlideshow = document.createElement('div');
            newSlideshow.className += (" " + classes.lightboxSlideshow);
            newSlideshow.style.display = "none";

        } else {
            newSlideshow.className += (' ' + classes.slideshowWrapper);
        }

        //Create div to wrap nav dots
        let navDots = document.createElement('div');
        navDots.className += " dot-nav";
        
        //Captures what will be the index of slideshow being built
        let slideshowIndex = swgl.initializedSlideshows.length + 1;
    
        swgl.addNavArrows(slideshowIndex, newSlideshow, classes);
    
        //Block of lightbox slideshow images
        let slideImgBlock = document.createElement('div');
        slideImgBlock.className = (" " + classes.slideshowImgBlock);
        slideImgBlock.addEventListener('click', swgl.closeLightbox);
    
        //Capture all img elements in gallery element,
        //spread them into an array for iteration                
        let images = [...galleryElem.getElementsByTagName('img')];
        for(var imgIndex = 0; imgIndex<images.length; imgIndex++){
    
            let img = images[imgIndex];
            let galleryIndex = imgIndex + 1;
            
            // Wrap image in div for easier styling
            const newSlide = swgl.createSlide(img, classes);
            newSliderInfo['allImgs'].push(newSlide);
            slideImgBlock.appendChild(newSlide);

            if(options.navDots){
                //Create new nav dot for new image
                const newDot = swgl.createNavDot(slideshowIndex, galleryIndex, classes);
                newSliderInfo['navDots'].push(newDot);
                navDots.appendChild(newDot);
            }

            // Appends a picture type class for styling(if needed)       
            let h = img.height;
            let w = img.width;
            if(h > w){ img.className += (" " + classes.portraitImg); }
            else { img.className += (" " + classes.landscapeImg); }
    
            let newGalleryImg = false;
            if(isLightbox){
                // Creates an 'a' element with background set to image
                newGalleryImg = swgl.createGalleryImage(img, slideshowIndex, galleryIndex);
    
                //Appends replacement anchor to original gallery element
                galleryElem.appendChild(newGalleryImg);
            }   

            // Loads images for slideshow and gallery
            swgl.loadImages(img, newGalleryImg, options);
        }
    
        //Add all created slideshow parts
        newSlideshow.appendChild(slideImgBlock);
        newSlideshow.appendChild(navDots);
    
        // Stores reference to slideshow element
        newSliderInfo['el'] = newSlideshow;
        //Push info onto list of made slideshows
        swgl.initializedSlideshows.push(newSliderInfo);
    
        // If slideshow is going into the lightbox
        if(isLightbox){
            swgl.getOverlay(classes).appendChild(newSlideshow);
        } else {
        // Otherwise, display the first image
            swgl.showSlide(slideshowIndex, 1);
        }
    },

    buildThumbUrl: (imgEl, thumbOptions)=>{
        const prefix = (thumbOptions.prefix || '');
        const suffix = (thumbOptions.suffix || '');
        const imgUrl = ( (imgEl.dataset.src || imgEl.getAttribute('src') || '').split('/') );
        
        const filePath = imgUrl.pop().split('.');
        const basePath = imgUrl.join('/');
        
        const ext = filePath.pop();
        const fileName = filePath.join('.');
        const thumbName = (prefix + fileName + suffix);
        
        // Uses passed in extension or same extension as main file
        return (basePath + '/' + thumbName + '.' + (thumbOptions.ext || ext) );
    },
    loadImages: (imgEl, galleryEl, options)=>{    
        setTimeout(()=>{
            // In case this is an inline slideshow
            if(galleryEl){
                let thumbUrl;
                let isThumb = false;
                if(options && options.thumbs) {
                    thumbUrl = swgl.buildThumbUrl(imgEl, options.thumbs);
                    isThumb = true;
                } else {
                    thumbUrl = (imgEl.dataset.src || imgEl.getAttribute('src'));
                }

                let thumbImg;
                
                if(!isThumb) {
                    thumbImg = imgEl;
                    if(imgEl.dataset.src){
                        imgEl.src = imgEl.dataset.src;
                    }    
                } else {
                    // Creates and loads new image for thumbnail
                    thumbImg = new Image();
                    thumbImg.src = thumbUrl;
                }

                thumbImg.onload = ()=>{ 
                    galleryEl.style.backgroundSize = "cover";
                    galleryEl.style.backgroundImage = "url('" + thumbUrl + "')";

                    if(thumbImg && imgEl.dataset.src){
                        imgEl.src = imgEl.dataset.src;
                    }    
                }
            } else {
                // Checks for src in dataset
                if(imgEl.dataset.src){
                    imgEl.src = imgEl.dataset.src;
                }
            }
        }, 1);
    },
    
    getOverlay: (classes)=>{
        let lightboxOverlay = document.getElementById('swgl-overlay');
        
        // If no overlay yet, create it
        if(!lightboxOverlay){
            lightboxOverlay = document.createElement('div');
            lightboxOverlay.id = 'swgl-overlay';
            lightboxOverlay.className += (" " + classes.lightboxOverlay);
            lightboxOverlay.style.display = "none";
                
            // Close btn in upper left
            const closeBtn = document.createElement('a');
            closeBtn.className += (" " +  classes.closeLighboxBtn);
            closeBtn.innerHTML = '<span class="'+ classes.xBtnBar + '"></span><span class="'+ classes.xBtnBar + '">';
            closeBtn.addEventListener('click', swgl.closeLightbox);
            lightboxOverlay.appendChild(closeBtn);
            
            // Append new overlay to document
            const body = document.getElementsByTagName('body')[0];
            body.appendChild(lightboxOverlay); 
        }
    
        // Return the overlay element
        return lightboxOverlay;
    },

    showLightbox: (sliderIndex, imgIndex)=>{
        let overlay = document.getElementById('swgl-overlay');
        //Hide all slideshows in lightbox
        let lightboxSlideshows = [...overlay.getElementsByClassName(swgl.classes.lightboxSlideshow)];
        for(let q = 0; q<lightboxSlideshows.length; q++){
            lightboxSlideshows[q].style.display = "none";
        }
        swgl.initializedSlideshows[sliderIndex -1].el.style.display = "block";
        if(overlay && overlay.style.display != "block"){ overlay.style.display = 'block'; }
        swgl.showSlide(sliderIndex, imgIndex);
    },
    closeLightbox: (e)=>{
        e.preventDefault();
        let overlay = document.getElementById('swgl-overlay');
        overlay.style.display = 'none';
    },

    createSlide: (img, classes)=>{
        //Wrap images in slideshow-styling div's
        const newSlide = document.createElement('div');
        newSlide.className += (" " + classes.slideshowSlide +  " " + classes.slideshowEffect);
        newSlide.appendChild(img);
        return newSlide;
    },
    createNavDot: (slideshowIndex, galleryIndex, classes)=>{
        const newDot = document.createElement('span');
        newDot.className += (" " + classes.slideshowDot);
        newDot.addEventListener('click', ()=>{
            swgl.showSlide(slideshowIndex, galleryIndex);
        });
        return newDot;
    },
    addNavArrows: (slideshowIndex, newSlideshow, classes)=>{
        //Create next/prev arrows
        let nextBtn = document.createElement('a');
        nextBtn.className += (" " + classes.prevArrow);
        nextBtn.innerHTML = "&#10094;";
        nextBtn.addEventListener('click', (e)=>{
            swgl.navigateSlides(slideshowIndex, -1, e);
        });
        let prevBtn = document.createElement('a');
        prevBtn.className += (" " + classes.nextArrow);
        prevBtn.innerHTML = "&#10095;";
        prevBtn.addEventListener('click', (e)=>{
            swgl.navigateSlides(slideshowIndex, 1, e);
        });
        newSlideshow.appendChild(nextBtn);
        newSlideshow.appendChild(prevBtn);
    },
    showSlide: (sliderIndex, imgIndex)=>{
        //First sets all images to be invisible
        const slideshow = swgl.initializedSlideshows[(sliderIndex-1)];
        for(let s = 0; s < slideshow.allImgs.length; s++){
            let img = slideshow.allImgs[s];
            img.style.display = 'none';
        }
    
        //Checks number passed in, setting final index accordingly 
        let showImg;
        if(imgIndex < 1){showImg = (slideshow.allImgs.length - 1);}
        else if(imgIndex > slideshow.allImgs.length){showImg = 0; }
        else { showImg = (imgIndex -1) }
        
        //Get html reference from list and sets style to be visible
        slideshow.allImgs[showImg].style.display = "flex";
    
    
        const dots = slideshow.navDots;
        //Removes 'active-dot' class from all dots
        if(dots.length > 0){
            for(let q=0; q<dots.length; q++){
                dots[q].className = dots[q].className.replace(" active-dot", "");
            }
            //Sets ' active-dot' on the index relative to img
            dots[showImg].className += " active-dot";
        }
    
        slideshow.current = showImg +1;
    },
    navigateSlides: (sliderIndex, direction, e)=>{
        e.preventDefault();
        //Takes either +1 or -1 int for 'direction'
        const slideshow = swgl.initializedSlideshows[sliderIndex-1];
        swgl.showSlide(sliderIndex, slideshow.current + direction)
    },

    createGalleryImage: (img, slideshowIndex, galleryIndex)=>{
        //*****Create a new anchor element to take the place of img element
        const newGalleryImg = document.createElement('a');
        newGalleryImg.setAttribute('href', '#');
        newGalleryImg.className += " gallery-img";
        newGalleryImg.style.backgroundSize = "20px";
        newGalleryImg.style.backgroundImage = "url('" + loadingGif + "')";
      
    
        // Add link to slideshow pic on click
        newGalleryImg.addEventListener('click', (e)=>{
            e.preventDefault();
            swgl.showLightbox(slideshowIndex, galleryIndex)
        });
    
        return newGalleryImg;
    },
};


// --- Initialize individually
window.addEventListener('DOMContentLoaded', ()=>{ 
    swgl.initGallery('gallery-1',
        {
            thumbs: {
                prefix: 't-',
                // suffix: '',
                // ext: 'jpg'
            },
        }
    );
    swgl.initSlideshow('slide-1');
    swgl.initGallery('gallery-2');
    swgl.initSlideshow('slide-2');
});

// --- OR initialize everything(slideshows and galleries) with default options like this
// window.addEventListener('DOMContentLoaded', swgl.autoInit);


// Encoded loading gif.
// Really, it might just be better to load an actual gif the traditional way to take advantage of caching
const loadingGif = 'data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==';