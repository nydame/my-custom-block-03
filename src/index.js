const { registerBlockType } = wp.blocks;
const { useBlockProps, RichText } = wp.blockEditor;
const { __ } = wp.i18n;
import './index.scss';
import './style.scss';
 
registerBlockType( 'pss-blocks/my-dynamic-gutenberg-block', {
  apiVersion: 2,
  title: 'Basic Dynamic Block with ESNext',
  icon: 'update',
  category: 'design',
  example: {},
  attributes: {
    content: {
      type: 'string',
      source: 'html',
      selector: 'p',
    },
    className: 'my-dynamic-gutenberg-block',
  },
  edit: ({ attributes, setAttributes }) => {
    const blockProps = useBlockProps();
    console.log(wp);
    return ( <RichText { ...blockProps } tagName='p' value={ attributes.content } allowedFormats={['core/bold', 'core/link']} onChange={ (content) => setAttributes({ content }) } placeholder={ __(`Say something`) } preserveWhiteSpace /> );
  },
  save: ({ attributes}) => {
    const blockProps = useBlockProps.save();
    return ( <div className='howdy'><RichText.Content { ...blockProps } tagName='aside' value={ attributes.content + " &mdash ❤️ f"} preserveWhiteSpace /></div> );
  },
} );