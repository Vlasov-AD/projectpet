const images = document.getElementsByClassName('image_block');
const length = images.length;
let currentSlide = 0;

images[0].style.display = 'block';

const nextButton = document.getElementById('next_slide');
const prevButton = document.getElementById('prev_slide')

//к следующему слайду
nextButton.addEventListener('click',  (event) =>{
	if (currentSlide === length-1)//если последний элемент
	{	
		images[currentSlide].style.display = 'none';
		images[0].style.display = 'block';
		currentSlide = 0;
	}else
	{	
		images[currentSlide].style.display = 'none';
		images[currentSlide+1].style.display = 'block';
		currentSlide++;
	}
});

//к предыдущему слайду
prevButton.addEventListener('click', (event) =>{
	if(currentSlide === 0)//если первый слайд
	{
		images[currentSlide].style.display = 'none';
		images[length-1].style.display = 'block';
		currentSlide = length-1;
	}else
	{
		images[currentSlide].style.display = 'none';
		images[currentSlide-1].style.display = 'block';
		currentSlide--;
	}

});