<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";
	const dispatch = createEventDispatcher();
	export let id, name;
	let selected = false;
	
	export const deselect_note = () => select_note = false;
	export const close_note = () => selected = false;
	
	function select_note() {
		if(selected)
			return;
		axios.post("http://localhost/Notas/getNote", { note_id: id })
			.then(resolved => {
				selected = true;
				dispatch("put_note", resolved.data);
			});
	}
</script>

<div on:click={select_note} class="box_note" class:select={selected}>
	<span class="gg-notes"></span>
	<span>{name}</span>
</div>

<style>
	.box_note {
		cursor: pointer;
		user-select: none;
		transition: all ease-in-out .1s;
		display: flex;
		padding: 10px 15px;
		margin-left: 1em;
		color: var(--snd-foreground);
	}
	.box_note.select {
		background: var(--snd-border-col);
		color: var(--foreground);
		font-weight: bold;
	}

	/*
	 * NOTE ICON CLASS
	 * */
	.gg-notes {
		flex: 0 0 auto;
		box-sizing: border-box;
		position: relative;
		display: inline-block;
		transform: scale(var(--ggs,1));
		width: 16px;
		height: 18px;
		border: 2px solid;
		border-radius: 3px;
		margin-right: 0.5em;
	}
	.gg-notes::after,
	.gg-notes::before {
		content: "";
		display: block;
		box-sizing: border-box;
		position: absolute;
		border-radius: 3px;
		height: 2px;
		background: currentColor;
		left: 2px;
	}
	.gg-notes::before {
		box-shadow:
			0 4px 0;
		width: 8px;
		top: 2px
	}
	.gg-notes::after {
		width: 4px;
		top: 10px
	} 
</style>
