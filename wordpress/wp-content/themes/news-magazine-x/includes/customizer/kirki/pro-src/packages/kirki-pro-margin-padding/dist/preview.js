wp.hooks.addFilter("kirkiPostMessageStylesOutput","kirki",(t,e,i,r)=>{if("kirki-margin"!==r&&"kirki-padding"!==r||!e.top&&!e.right&&!e.bottom&&!e.left)return t;let k=r.replace("kirki-","");for(let r in t+=i.element+"{",e)if(Object.hasOwnProperty.call(e,r)){let i=e[r];""!==i&&(t+=k+"-"+r+": "+i+";")}return t+"}"});
//# sourceMappingURL=preview.js.map
