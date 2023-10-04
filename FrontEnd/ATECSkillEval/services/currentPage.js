

export function CurrentPage() {
  const url = window.location.pathname;

  if (url) 
  {
    const pathSegments = url.split('/');


      const page = pathSegments[pathSegments.length - 2];
      return page
    }

}
