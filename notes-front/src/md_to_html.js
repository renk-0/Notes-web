let TOKENS = {
	line: "<hr>",
	bold: "<b>$1</b>",
	italic: "<i>$1</i>",
	paragraph: "<br>",
	list: "<li>$1</li>",
	header: (str, p1, p2) => "<h" + p1.length + ">" + p2 + "</h" + p1.length + ">" 
};


const paragraphs = (t) => t
	.replace(/\n{2,}/gim, TOKENS.paragraph);
const header = (t) => t
	.replace(/^(#{1,6}) (.*?)$/gim, TOKENS.header);
const list = (t) => t
	.replace(/^- (.*?)/gim, TOKENS.list)
	.replace(/^+ (.*?)/gim, TOKENS.list)
	.replace(/^* (.*?)/gim, TOKENS.list);
const horizontal_line = (t) => t
	.replace(/^\*\*\*[	 ]*$/gim, TOKENS.line)
	.replace(/^---[ 	]*$/gim, TOKENS.line)
	.replace(/^___[ 	]*$/gim, TOKENS.line);
const text_bold = (t) => t
	.replace(/__(.*?)__/gim, TOKENS.bold)
	.replace(/\*{2}(.*?)\*{2}/gim, TOKENS.bold);
const text_italic = (t) => t
	.replace(/\*(.*?)\*/gim, TOKENS.italic)
	.replace(/:(.*?)_/gim, TOKENS.italic);

function MD_TO_HTML(t) {
	// STARTING TO CONVERT TO HTML
	t = list(t);
	t = header(t);
	t = horizontal_line(t);
	t = text_bold(t);
	t = text_italic(t);
	t = paragraphs(t);
	return t;
}


export default MD_TO_HTML;
