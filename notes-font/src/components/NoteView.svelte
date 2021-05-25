<script>
	import NoteBar from "./NoteBar.svelte";
	import axios from "axios";
	import marked from "marked";

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
			<textarea on:input={change_text} 
				class="text_container edit_text">{noteData.content}</textarea>
		{:else}
			<div class="text_container preview"
			>{@html marked(noteData.content)}</div>
		{/if}
	{:else}
		<div class="text_container empty">
			<span class="empty_text">Select a note</span> 		
		</div>
	{/if}
</div>

<style>
	.note_view {
		flex: 10 1 500px;
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
		overflow: auto;
		background: var(--background);
		border: none;
		margin: 0;
		box-sizing: border-box;
		width: 100%;
		height: 100%;
		padding: 10px;
	}
</style>
