<script>
	import NoteBar from "./NoteBar.svelte";
	import axios from "axios";
	import marked from "marked";
	import hljs from "highlight.js";
	import 'highlight.js/styles/gruvbox-dark.css';

	marked.setOptions({
		highlight: function(code, lang) {
			const language = hljs.getLanguage(lang)? lang : "plaintext";
			return hljs.highlight(code, { language }).value;
		}
	});

	let editing = false;
	let noteData;

	export const toggle = () => editing = !editing;
	export const put_note = (e) => noteData = e.detail[0];
	const change_text = (el) => noteData.content =  el.target.value;

	function save_data() {
		axios.post("http://localhost/Notas/updateNote", noteData)
			.then(resolve => alert("Saved"));
	}
</script>

<div class="note_view">
	<NoteBar
		on:save_changes={save_data}
		on:changed_switch={toggle} />
	{#if noteData}
		{#if editing}
			<textarea class="text_container edit_text"
				on:input={change_text}>{noteData.content}</textarea>
		{:else}
			<div class="text_container preview">
				{@html marked(noteData.content)}
			</div>
		{/if}
	{:else}
		<div class="text_container empty">
			<span class="empty_text">Select a note</span> 		
		</div>
	{/if}
</div>

<style>
	.note_view {
		flex: 10 1 400px;
		height: 100%;
		display: flex;
		flex-flow: column nowrap;
	}
	.edit_text {
		line-height: 1.5em;
		resize: none;
		outline: none;
		color: var(--foreground);
	}
	.empty {
		font-weight: bold;
		display: flex;
		color: var(--snd-border-col);
		font-family: 'Farro', sans-serif;
		font-size: 1.6em;
	}
	.empty_text {
		margin: auto;
	}
	.text_container {
		height: 100%;
		overflow: auto;
		background: var(--background);
		border: none;
		margin: 0;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		color: var(--trd-foreground);
	}

</style>
