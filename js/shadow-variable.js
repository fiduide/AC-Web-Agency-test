/**
 * We rename kudos to maxKudos so that it is understandable from the beginning.
 * Change var ton const.
 * The "calculateTotalKudos" function is refactored to use the "reduce" method to calculate the sum of kudos
 * Arrow function for more clarity
 */

const articleList = []; // In a real app this list would be full of articles.
const maxKudos = 5;

const calculateTotalKudos = (articles) => {
  return articles.reduce((total, article) => total + article.kudos, 0);
};

document.write(`
  <p>Maximum kudos you can give to an article: ${maxKudos}</p>
  <p>Total Kudos already given across all articles: ${calculateTotalKudos(
    articleList
  )}</p>
`);
