import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import './index.scss';
import './style.scss';

const blockStyle = {
  backgroundColor: '#900',
  color: '#fff',
  padding: '20px',
}
 
registerBlockType( 'pss-blocks/my-styled-gutenberg-block', {
  apiVersion: 2,
  title: 'Basic Styled Block with ESNext',
  icon: 'art',
  category: 'design',
  example: {},
  edit() {
    const blockProps = useBlockProps();
    return (<div { ...blockProps }>I am green (from the editor)</div>);
  },
  save() {
    const blockProps = useBlockProps.save();
    return (<div { ...blockProps }>I am yellow (from the frontend)</div>);
  },
} );