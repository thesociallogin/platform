import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card.jsx'
import { motion } from 'framer-motion'

export default function Testimonials() {
  const testimonials = [
    {
      quote: "The Social Login has revolutionized our authentication process. It's fast, secure, and our users love it!",
      author: 'Alex Johnson',
      role: 'CTO, TechCorp'
    },
    {
      quote: 'Implementing SSO with The Social Login was a breeze. It saved us weeks of development time.',
      author: 'Sarah Lee',
      role: 'Product Manager, InnovateCo'
    },
    {
      quote: "The support team at The Social Login is exceptional. They're always there when we need them.",
      author: 'Michael Chen',
      role: 'Founder, StartupX'
    }
  ]

  return (
    <section className='w-full bg-zinc-50 py-12 md:py-24 lg:py-32'>
      <div className='container mx-auto max-w-6xl px-4 md:px-6'>
        <motion.h2
          className='mb-12 text-center text-3xl font-bold tracking-tighter sm:text-5xl'
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          What Our Clients Say
        </motion.h2>
        <div className='grid grid-cols-1 gap-8 md:grid-cols-3'>
          {testimonials.map((testimonial, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: index * 0.1, duration: 0.5 }}
            >
              <Card>
                <CardHeader>
                  <CardTitle>Testimonial</CardTitle>
                </CardHeader>
                <CardContent>
                  <p className='mb-4 text-zinc-600'>"{testimonial.quote}"</p>
                  <p className='font-bold'>{testimonial.author}</p>
                  <p className='text-zinc-500'>{testimonial.role}</p>
                </CardContent>
              </Card>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
