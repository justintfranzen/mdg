export const initNewWindow = () => {
  const buttonLink = document.querySelector('.button a');

  if (!buttonLink) {
    return;
  }

  if (
    buttonLink.href.includes('youtube.com') ||
    buttonLink.href.includes('youtu.be')
  ) {
    buttonLink.setAttribute('target', '_blank');
  }
};
