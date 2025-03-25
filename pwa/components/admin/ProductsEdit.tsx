import { EditGuesser, InputGuesser } from "@api-platform/admin";

export const ProductsEdit = (props) => (
    <EditGuesser {...props}>
        <InputGuesser source="name" />
        <InputGuesser source="price" />
        <InputGuesser source="categories" optionText="code" />
    </EditGuesser>
);
