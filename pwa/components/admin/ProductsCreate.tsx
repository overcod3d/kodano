import { CreateGuesser, InputGuesser } from "@api-platform/admin";

export const ProductsCreate = () => (
    <CreateGuesser>
        <InputGuesser source="name" />
        <InputGuesser source="price" />
        <InputGuesser source="categories" optionText="code" />
    </CreateGuesser>
);
