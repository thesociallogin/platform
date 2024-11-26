import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'

export default function FAQ() {
  const faqs = [
    {
      question: 'What is SSO and how does it work?',
      answer:
        'SSO (Single Sign-On) is an authentication method that allows users to access multiple applications with a single set of credentials. When a user logs in to one application, they are automatically authenticated for all other connected applications.'
    },
    {
      question: 'Which social login providers do you support?',
      answer:
        'We support all major social login providers including Google, Facebook, Twitter, LinkedIn, and many more. Our list of supported providers is constantly growing.'
    },
    {
      question: 'Is The Social Login GDPR compliant?',
      answer:
        'Yes, The Social Login is fully GDPR compliant. We take data privacy seriously and ensure that all user data is handled in accordance with GDPR regulations.'
    },
    {
      question: 'How long does it take to integrate The Social Login?',
      answer:
        'Integration time can vary depending on your specific needs, but most of our clients are up and running within a day. Our comprehensive documentation and support team are there to help you every step of the way.'
    }
  ]

  return (
    <section className='w-full bg-zinc-100 py-12 md:py-24 lg:py-32'>
      <div className='container mx-auto max-w-6xl px-4 md:px-6'>
        <h2 className='mb-12 text-center text-3xl font-bold tracking-tighter sm:text-5xl'>Frequently Asked Questions</h2>
        <Accordion type='single' collapsible className='mx-auto w-full max-w-3xl'>
          {faqs.map((faq, index) => (
            <AccordionItem key={index} value={`item-${index}`}>
              <AccordionTrigger>{faq.question}</AccordionTrigger>
              <AccordionContent>{faq.answer}</AccordionContent>
            </AccordionItem>
          ))}
        </Accordion>
      </div>
    </section>
  )
}
