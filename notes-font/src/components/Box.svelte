<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";
	import Nota from "./Note.svelte";
	const dispatch = createEventDispatcher();
	
	export let id, name, creation;
	let currentNote;
	let open = false;
	let notas = [];

	export const close_box = () => {
		open = false;
		currentNote = undefined;
	} 
	export const get_note = () => currentNote;
	export const get_id = () => id;
	export const add_note = (note) => notas[notas.length] = note;
	
	function open_box() {
		if(open)
			return;
		axios.post("http://localhost/Notas/getNotes", { box_id: id })
			.then(resolved => {
				open = true;
				dispatch("opened");
				notas = resolved.data;
			});
	}
	
	function change_note(e) {
		if(currentNote)
			currentNote.toggle();
		currentNote = this;
		dispatch("view_note", e.detail);
	}

</script>

<div on:click={open_box} class="box" class:selected={open}>
	<div class="box_header" class:selected={open}>
		<span class="gg-chevron-right" class:chevron-down={open}></span>
		<span>{name}</span>
	</div>
	<div class="box_content" class:open={open}>
		{#if open}
			{#each notas as nota}
				<Nota {...nota} on:put_note={change_note}/>
			{/each}
		{/if}
	</div>
</div>

<style>
	.box_header {
		color: var(--snd-foreground);
		transition: background ease-in-out .1s;
		display: flex;
		padding: 10px 15px;
		align-items: center;
		user-select: none;
		cursor: pointer;
	}
	.box_header.selected {
		background: var(--aqua);
		color: var(--background);
		font-weight: bold;
	}

	.box_content {
		transition: all ease-in-out .2s;
		opacity: 0;
	}
	.box_content.open { opacity: 1; }

	/*
	 * CHEVRON ARROW
	 * */
	.gg-chevron-right {
		box-sizing: border-box;
		position: relative;
		display: inline-block;
		transform: scale(var(--ggs, 1));
		width: 20px;
		height: 20px;
		border: 2px solid transparent;
		border-radius: 100px;
		flex: 0 0 auto;
	}
	.gg-chevron-right::after {
		transition: all ease-in-out .1s;
		content: "";
		display: block;
		box-sizing: border-box;
		position: absolute;
		width: 8px;
		height: 8px;
		border-bottom: 2px solid;
		border-right: 2px solid;
		transform: rotate(-45deg);
		right: 6px;
		top: 5px
	}
	.gg-chevron-right.chevron-down::after {
		transform: rotate(45deg);
		top: 2px;
	}
</style>
